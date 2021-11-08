<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
    protected $fillable = [
        'student_id',
        'announcement_id',
    ];
}
