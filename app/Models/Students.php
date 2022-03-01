<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    
    protected $fillable = ['first_name','last_name','middle_name','group_id'];

    public function group(){

        return $this->belongsTo(Groups::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class, 'scores','student_id','subject_id')->withPivot('score');;
    }
}
