<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StartTime;
use App\Models\Duration;
use App\Models\Course;
use App\Models\LearningHour;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = ['name', 'dob', 'address', 'mobile', 'email', 'start_date', 'start_time', 'learning_hour', 'duration', 'course', 'avatar', 'end_date', 'end_time'];

    public function start_time() {
        return $this->hasOne(StartTime::class, 'id', 'start_time');
    }

    public function course() {
        return $this->hasOne(Course::class, 'id', 'course');
    }

    public function duration() {
        return $this->hasOne(StartTime::class, 'id', 'duration');
    }

    public function learning_hour() {
        return $this->hasOne(LearningHour::class, 'id', 'learning_hour');
    }
}
