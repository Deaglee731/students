<?php

namespace App\Services;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileServices
{
    public static function getAvatarLink(Student $student)
    {
        if ($student->avatar_path) {
            if (!Storage::disk('avatars')->exists("$student->id/$student->avatar_path"."_resized.jpg")) {
                Image::make("avatars/$student->id/$student->avatar_path")->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("avatars/$student->id/$student->avatar_path"."_resized.jpg");
            }
            return Storage::disk('avatars')->url("$student->id/$student->avatar_path"."_resized.jpg");
        } else {
            return Storage::disk('avatars')->url("default.jpg");
        }
    }

    public static function updateAvatar($student , $request) {

        $filename = $request->file('avatar')->getClientOriginalName();
        $student->update(['avatar_path' => $filename]);

        $request->file('avatar')->storeAs(
            "avatars/$student->id", $filename
        );
    }

    public static function getStudentList($students)
    {
        $pdf = FacadePdf::loadView('students.list', [
            'students' => $students,

        ])->setOptions(['defaultFont' => 'sans-serif']);
        
        return $pdf->download('StudentList.pdf');
    }

}
