<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    const COLOR_GREEN = 'green';
    const COLOR_YELLOW = 'yellow';
    const COLOR_RED = 'red';

    protected $fillable = [
        'address',
        'email', 
        'password', 
        'first_name', 
        'last_name', 
        'middle_name', 
        'group_id', 
        'birthday',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'address' => 'array',
        'email_verified_at' => 'datetime',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'scores', 'student_id', 'subject_id')->withPivot('score');
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

    public function setAddressAttribute($address)
    {
        $address['city'] = ucfirst($address['city']);
        $address['street'] = ucfirst($address['street']);
        $address['home'] = ucfirst($address['home']);

        $this->attributes['address'] = json_encode($address);
    }

    public function getFullAddressAttribute()
    {
        return  "Город  " . $this->address['city'] ?? ' '.
            "  Улица  " . $this->address['street'] ?? ' '.
            " Дом  " . $this->address['home'] ?? ' ';
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request->firstname)) {
            $query->Where('first_name', 'LIKE', "%$request->firstname%");
        }

        if (isset($request->lastname)) {
            $query->Where('last_name', 'LIKE', "%$request->lastname%");
        }
        
        if (isset($request->middlename)) {
            $query->Where('middle_name', 'LIKE', "%$request->middlename%");
        }
        
        if (isset($request->birthday)) {
            $query->Where('birthday', $request->birthday);
        }

        return $query;
    }
}
