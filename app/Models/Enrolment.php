<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function fees()
    {
        return $this->hasMany('App\Models\Fee');
    }

    public function schoolYear()
    {
        return $this->belongsTo('App\Models\SchoolYear');
    }

    public function enroledBy()
    {
        return $this->belongsTo('App\Models\User','enroled_by','id');
    }

    public function getEnrolmentSubject($subject_id)
    {
        $data = EnrolmentSubjects::where('enrolment_id', $this->id)->where('subject_id',$subject_id)->first();
        return $data;
    }
}
