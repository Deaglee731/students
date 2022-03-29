<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @OA\Schema(
 *      schema="Student",
 *      required={"id", "first_name", "last_name", "middle_name", "group_id", "birthday", "role_id"},
 * 
 *      @OA\Property (
 *          property="id", description="id",
 *          type="number", example="1",
 *      ),
 *      @OA\Property (
 *          property="first_name", description="first_name",
 *          type="string", example="Alex",
 *      ),
 *      @OA\Property (
 *          property="last_name", description="last_name",
 *          type="string", example="Ivanov",
 *      ),
 *      @OA\Property (
 *          property="middle_name", description="middle_name",
 *          type="string", example="Timurovich",
 *      ),
 *      @OA\Property (
 *          property="group_id", description="group_id",
 *          type="number", example="10",
 *      ),
 *      @OA\Property (
 *          property="birthday", description="birthday",
 *          type="date", example="1998-02-02",
 *      ),
 *      @OA\Property (
 *          property="role_id", description="role_id",
 *          type="nubmer", example="2",
 *      ),
 * )
 *
 */
class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const COLOR_GREEN = 'green';
    public const COLOR_YELLOW = 'yellow';
    public const COLOR_RED = 'red';

    protected $fillable = [
        'address',
        'email',
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'group_id',
        'birthday',
        'role_id',
        'avatar_path',
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
        return "{$this->first_name} {$this->last_name}";
    }

    public function getColorAttribute()
    {
        $min_score = $this->subjects()->min('score');

        if ($min_score === 5) {
            return self::COLOR_GREEN;
        }

        if ($min_score === 4) {
            return self::COLOR_YELLOW;
        }

        return self::COLOR_RED;
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
        return "Город {$this->address['city']}
                Улица {$this->address['street']} 
                Дом {$this->address['home']}";
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request->firstname)) {
            $query->Where('first_name', 'LIKE', "%{$request->firstname}%");
        }

        if (isset($request->lastname)) {
            $query->Where('last_name', 'LIKE', "%{$request->lastname}%");
        }

        if (isset($request->middlename)) {
            $query->Where('middle_name', 'LIKE', "%{$request->middlename}%");
        }

        if (isset($request->birthday)) {
            $query->Where('birthday', $request->birthday);
        }

        if (isset($request->isAdmin)) {
            $query->withTrashed()->orderByDesc('deleted_at');
        }

        return $query;
    }

    public function getRoleAttribute()
    {
        return $this->role_id;
    }
}
