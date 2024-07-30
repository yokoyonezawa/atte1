<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time'
        ];

    protected $dates = ['start_time', 'end_time'];

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s');
    }


    public function breaks()
    {
        return $this->hasMany(WorkBreak::class);
    }

    public function calculateWorkHours()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);

        // 終了時間が開始時間よりも前の場合、翌日として扱う
        if ($end->lt($start)) {
            $end->addDay();
        }

        // 休憩時間を計算
        $breaks = $this->breaks->sum(function ($break) {
            $breakStart = Carbon::parse($break->start_time);
            $breakEnd = Carbon::parse($break->end_time);

            // 休憩終了時間が開始時間よりも前の場合、翌日として扱う
            if ($breakEnd->lt($breakStart)) {
                $breakEnd->addDay();
            }
            return $breakStart->diffInSeconds($breakEnd);
        });

        // 勤務時間を秒単位で計算
        $totalSeconds = $end->diffInSeconds($start) - $breaks;

        // 秒単位の勤務時間を時分秒に変換
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        // フォーマットして返す
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
