<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Score",
 *      required={"id", "student_id", "subject_id"},
 *      @OA\Property (
 *          property="score", description="Score",
 *          type="number", example="5",
 *      ),
 *      @OA\Property (
 *          property="student_id", description="Student",
 *          type="number", example="11",
 *      ),
 *      @OA\Property (
 *          property="subject_id", description="Subject",
 *          type="number", example="13",
 *      ),
 * )
 *
 */
class Score extends Model
{
    use HasFactory;
}
