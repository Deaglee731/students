<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const COLOR_GREEN = 'green';
    const COLOR_YELLOW = 'yellow';
    const COLOR_RED = 'red';

    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'middle_name', 'group_id', 'birthday'];

    protected $casts = [
        'address' => 'array',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'scores', 'student_id', 'subject_id')->withPivot('score');;
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getColorAttribute()
    {
        $min_score  = $this->subjects()->min('score');

        if ($min_score == 5) {
            return self::COLOR_GREEN;
        } elseif ($min_score == 4) {
            return self::COLOR_YELLOW;
        } else {
            return self::COLOR_RED;
        }
    }

    public function getBirthdayAttribute($date)
    {
        return Carbon::parse($date)->format('d-m-Y');
    }

    public function setAddressAttribute($address)
    {
        $address['city'] = ucfirst($address['city']);
        $address['street'] = ucfirst($address['street']);
        $address['home'] = ucfirst($address['home']);
        $this->attributes['address'] = json_encode($address);
    }

    public function getFullAddressAttribute()
    {
        return  "Город  " . $this->address['city'] . "  Улица  " . $this->address['street'] . " Дом  " . $this->address['home'];
    }
}
