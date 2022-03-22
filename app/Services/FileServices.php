<?php

namespace App\Services;

use App\Http\Requests\AvatarRequest;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileServices
{
    public static function getAvatarLink(Student $student)
    {
        if ($student->avatar_path){
            Image::make($student->avatar_path)->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save("$student->avatar_path"."_resized.jpg");

            return "$student->avatar_path"."_resized.jpg";
        }
        else {
            return Storage::disk('avatars')->url("default.jpg");
        }
    }

    public static function getStudentList($students)
    {
        $pdf = FacadePdf::loadView('students.list', [
            'students' => $students,

        ])->setOptions(['defaultFont' => 'sans-serif']);
        
        return $pdf->download('StudentList.pdf');
    }
}
