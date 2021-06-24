<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolmentSubjects extends Model
{
    use HasFactory;

    public $guarded = [];

    public function studentGrade()
    {
        return $this->hasMany('App\Models\StudentGrade','enrolment_subject_id','id');
    }

    public function enrolment()
    {
        return $this->belongsTo('App\Models\Enrolment');
    }
}
