<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;


    public function group(){

        return $this->belongsTo(Groups::class);
    }


    public function subjects(){

        return $this->belongsToMany(Subjects::class,'scores');
    }

}
