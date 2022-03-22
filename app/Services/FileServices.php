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
        if (Storage::disk('avatars')->exists("$student->id/avatar_resize.jpg")) {
            return Storage::disk('avatars')->url("$student->id/avatar_resize.jpg");
        } elseif (Storage::disk('avatars')->exists("$student->id/avatar.jpg")) {
            return Storage::disk('avatars')->url("$student->id/avatar.jpg");
        } else {
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
