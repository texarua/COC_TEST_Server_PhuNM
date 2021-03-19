<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasion extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = ['name', 'dob', 'address', 'mobile', 'email', 'start_date', 'start_time', 'learning_hour', 'duration', 'course', 'avatar', 'end_date', 'end_time'];

    // public function start_time() {
    //     return $this->has
    // }
}
