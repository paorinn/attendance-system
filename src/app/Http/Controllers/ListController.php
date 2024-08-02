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
        ->with('user') // 'user'リレーションをロードする  
        ->orderBy('clockIn', 'desc')  
        ->get();  

    $items = $attendances->groupBy(function($attendance) {  
        return Carbon::parse($attendance->clockIn)->toDateString();  
    })->map(function($dateAttendances, $date) {  
        return $dateAttendances->map(function($attendance) {  
            $breakInTime = $attendance->breakIn ? $attendance->breakIn->format('H:i') : null;  
            $breakOutTime = $attendance->breakOut ? $attendance->breakOut->format('H:i') : null;  

            $totalBreakTime = 0;  
            if ($attendance->breakIn && $attendance->breakOut) {  
                $totalBreakTime = $attendance->breakOut->diffInSeconds($attendance->breakIn);  
            }  

            return [  
                'user_name' => $attendance->user->name, // 'user.name'を使用する  
                'punchIn' => $attendance->clockIn->format('H:i'),  
                'breakIn' => $breakInTime,  
                'breakOut' => $breakOutTime,  
                'punchOut' => $attendance->clockOut ? $attendance->clockOut->format('H:i') : null,  
                'workTime' => $attendance->workTime,  
                'totalBreakTime' => $totalBreakTime,  
            ];  
        })->values()->all();  
    })->values()->all();

    return view('attendance', compact('items'));  
}
}