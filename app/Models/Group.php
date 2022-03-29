<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Group",
 *      required={"id", "name"},
 *      @OA\Property (
 *          property="id", description="id",
 *          type="number", example="1",
 *      ),
 *      @OA\Property (
 *          property="name", description="Group_name",
 *          type="string", example="IVT-[123]",
 *      ),
 * )
 *
 */
class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request->name)) {
            return $query->where('name', 'LIKE', "%{$request->name}%");
        }
    }
}
