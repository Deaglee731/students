<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function scopeFilter($query, $request)
    {      
        if (isset($request->name)) {
            return $query->where('name', 'LIKE', "%$request->name%");
        }
    }
}
