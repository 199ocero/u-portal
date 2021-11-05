<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSection extends Model
{
    
    protected $fillable = [
        'section_id',
        'student_id',
    ];
    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }
    
}
