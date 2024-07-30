<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkBreak extends Model
{
    use HasFactory;

    protected $table = 'workbreaks';

    protected $fillable = ['stamp_id', 'start_time', 'end_time'];

    public function stamp()
    {
        return $this->belongsTo(Stamp::class);
    }
}