<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Time;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $items = Time::whereDate('date', $today->format('Y-m-d'))
                    ->get();
        return view('index', compact('items'));
    }

    public function clockIn()
    {
        $user = Auth::user();
        $latestRecord = Time::where('user_id', $user->id)
                            ->latest()
                            ->first();

        $today = Carbon::today();

        // 同じ日に2回出勤が押せない
        if ($latestRecord && $latestRecord->clockIn && !$latestRecord->clockOut) {
            return redirect()->back()->with('message', '出勤打刻済みです');
        }

        // 退勤後に再度出勤を押せない
        if ($latestRecord && $latestRecord->clockOut) {
            return redirect()->back()->with('message', '退勤打刻済みです');
        }

        Time::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'clockIn' => Carbon::now(),
            'date' => $today->format('Y-m-d'),
        ]);

        return redirect()->back()->with('message', '出勤時間を記録しました');
    }

    public function clockOut()
    {
        $user = Auth::user();
        $latestRecord = Time::where('user_id', $user->id)
                            ->latest()
                            ->first();

        if (!$latestRecord || $latestRecord->clockOut) {
            return redirect()->back()->with('message', '出勤打刻がされていません');
        }

        if ($latestRecord->breakIn && !$latestRecord->breakOut) {
            return redirect()->back()->with('message', '休憩終了が打刻されていません');
        }

        $now = Carbon::now();
        $clockIn = Carbon::parse($latestRecord->punchIn);
        $breakIn = Carbon::parse($latestRecord->breakIn);
        $breakOut = Carbon::parse($latestRecord->breakOut);

        $stayTime = $punchIn->diffInMinutes($now);
        $breakTime = $breakIn->diffInMinutes($breakOut);
        $workingMinute = $stayTime - $breakTime;
        $workingHour = ceil($workingMinute / 15) * 0.25;

        $latestRecord->update([
            'clockOut' => $now,
            'workTime' => $workingHour,
        ]);

        return redirect()->back()->with('message', 'お疲れ様でした');
    }

    public function breakIn()
    {
        $user = Auth::user();
        $latestRecord = Time::where('user_id', $user->id)
                            ->latest()
                            ->first();

        if ($latestRecord->clockIn && !$latestRecord->clockOut && !$latestRecord->breakIn) {
            $latestRecord->update([
                'breakIn' => Carbon::now(),
            ]);
            return redirect()->back();
        }

        return redirect()->back()->with('message', '休憩を開始しました');
    }

    public function breakOut()
    {
        $user = Auth::user();
        $latestRecord = Time::where('user_id', $user->id)
                            ->latest()
                            ->first();

        if ($latestRecord->breakIn && !$latestRecord->breakOut) {
            $latestRecord->update([
                'breakOut' => Carbon::now(),
            ]);
            return redirect()->back();
        }

        return redirect()->back()->with('message', '休憩を終了しました');
    }
}