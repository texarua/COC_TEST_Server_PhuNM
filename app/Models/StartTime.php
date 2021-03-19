<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartTime extends Model
{
    use HasFactory;

    protected $table = 'start_times';

    protected $fillable = ['time'];
}
