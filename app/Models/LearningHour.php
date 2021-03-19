<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningHour extends Model
{
    use HasFactory;

    protected $table = 'learning_hours';

    protected $fillable = ['time'];
}
