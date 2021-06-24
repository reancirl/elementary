<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = [];

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function studentGrade()
    {
        return $this->belongsTo('App\Models\StudentGrade');
    }
}
