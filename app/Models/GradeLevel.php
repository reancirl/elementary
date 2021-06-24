<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory,SoftDeletes;

    public $guarded = [];

    public function subjects() {
        return $this->hasMany('App\Models\Subject')->where('status',1);
    }
}
