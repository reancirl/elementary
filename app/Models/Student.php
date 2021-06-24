<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrolment;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function gradeLevel()
    {
        return $this->belongsTo('App\Models\GradeLevel', 'grade_level_entered');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\StudentParent', 'student_id', 'id');
    }

    public function enrolment()
    {
        return $this->hasMany('App\Models\Enrolment');
    }

    public function fees()
    {
        return $this->hasMany('App\Models\Fee');
    }

    public function getLatestEnrolment()
    {
        $data = Enrolment::where('student_id', $this->id)->latest()->first();
        return $data;
    }
}
