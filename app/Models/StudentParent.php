<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'parents';

    public $guarded = [];
}
