<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Subject",
 *      required={"id", "name"},
 *      @OA\Property (
 *          property="id", description="id",
 *          type="number", example="1",
 *      ),
 *      @OA\Property (
 *          property="name", description="Subject name",
 *          type="string", example="Subject-3212",
 *      ),
 * )
 */
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
            return $query->where('name', 'LIKE', "%{$request->name}%");
        }

        return $query;
    }
}
