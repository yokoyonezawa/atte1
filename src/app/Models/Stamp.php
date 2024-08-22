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

        if ($end->lt($start)) {
            $end->addDay();
        }


        $breaks = $this->breaks->sum(function ($break) {
            $breakStart = Carbon::parse($break->start_time);
            $breakEnd = Carbon::parse($break->end_time);


            if ($breakEnd->lt($breakStart)) {
                $breakEnd->addDay();
            }
            return $breakStart->diffInSeconds($breakEnd);
        });


        $totalSeconds = $end->diffInSeconds($start) - $breaks;

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    // public function calculateWorkHours()
    // {
    //     $startTime = Carbon::parse($this->start_time);
    //     $endTime = $this->end_time ? Carbon::parse($this->end_time) : Carbon::now();
    //     $workDuration = $startTime->diffInSeconds($endTime);

    //     return gmdate('H:i:s', $workDuration);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
