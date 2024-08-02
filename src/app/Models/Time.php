<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'attendance';
    protected $fillable =['user_id','user_name','date','clockIn','clockOut','breakIn','breakOut','workTime'];

    protected $casts = [
        'date' =>'datetime:Y-m-d',
        'clockIn' =>'datetime:H:i',
        'clockOut' =>'datetime:H:i',
        'breakIn' =>'datetime:H:i',
        'breakOUt' =>'datetime:H:i',
    ];

    //リレーション
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //任意の日の勤怠をスコープ
    public function scopeGetDayAttendance($query,$date) {
        return $query->where('date',$date);
    }
}