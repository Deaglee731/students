<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = ['first_name','last_name','middle_name','group_id'];

    public function group(){

        return $this->belongsTo(Group::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'scores','student_id','subject_id')->withPivot('score');;
    }

}
