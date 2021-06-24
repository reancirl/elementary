<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function fee()
    {
        return $this->belongsTo('App\Models\Fee');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','catered_by','id');
    }
}
