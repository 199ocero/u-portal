<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    protected $fillable = [
        'student_id',
        'facebook_id'
    ];
}
