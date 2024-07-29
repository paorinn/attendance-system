<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\Time;  
use Illuminate\Support\Facades\Auth;  
use Carbon\Carbon;  
use App\Models\User;  

class ListController extends Controller  
{  
    public function date()  
    {  
        $user = Auth::user();  
        $attendances = Time::where('user_id', $user->id)  
            ->orderBy('date', 'desc')  
            ->orderBy('clockIn', 'desc')  
            ->get();  

        $items = $attendances->groupBy('date')->map(function ($dateAttendances, $date) {  
            $totalBreakTime = 0;  
            foreach ($dateAttendances as $attendance) {  
                $breakInTime = $attendance->breakIn ? Carbon::parse($attendance->breakIn) : null;  
                $breakOutTime = $attendance->breakOut ? Carbon::parse($attendance->breakOut) : null;  
                if ($breakInTime && $breakOutTime) {  
                    $totalBreakTime += $breakInTime->diffInMinutes($breakOutTime);  
                }  
            }  

            $firstAttendance = $dateAttendances->first();  

            $punchIn = null;  
            if ($firstAttendance && $firstAttendance->clockIn instanceof Carbon\Carbon) {  
                $punchIn = $firstAttendance->clockIn->format('H:i');  
            }  

            return [  
                'user_name' => $dateAttendances->first()->user_name,  
                'date' => $date,  
                'punchIn' => $punchIn,  
                'punchOut' => $dateAttendances->last()->clockOut ? $dateAttendances->last()->clockOut->format('H:i') : null,  
                'totalBreakTime' => $totalBreakTime,  
                'workTime' => $dateAttendances->sum('workTime'),  
            ];  
        });  

        return view('attendance', [  
            'items' => $items  
        ]);  
    }  
}