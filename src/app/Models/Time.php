<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'attendance';
    protected $fillable =['user_id','user_name','date','clockIn','clockOut','breakIn','breakOut','workTime'];

    //リレーション
    public function user()
    {
        $this->belongsTo('App\User');
    }

    //任意の日の勤怠をスコープ
    public function scopeGetDayAttendance($query,$date) {
        return $query->where('date',$date);
    }
}
