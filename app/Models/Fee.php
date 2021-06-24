<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function enrolment()
    {
        return $this->belongsTo('App\Models\Enrolment');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
