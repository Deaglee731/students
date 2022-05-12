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
        $path = "{$student->id}/{$student->avatar_path}";

        if ($student->avatar_path) {
            if (!Storage::disk('avatars')->exists("{$path}_resized.jpg")) {
                Image::make("avatars/{$path}")->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("avatars/{$path}_resized.jpg");
            }

            return Storage::disk('avatars')->url("{$path}_resized.jpg");
        }

        return Storage::disk('avatars')->url('default.jpg');
    }

    public static function updateAvatar($student, $request)
    {
        $filename = $request->file('avatar')->getClientOriginalName();
        $student->update(['avatar_path' => $filename]);

        $request->file('avatar')->storeAs(
            "avatars/{$student->id}",
            $filename
        );
    }

    public static function getStudentList($students)
    {
        $pdf = FacadePdf::loadView('students.list', [
            'students' => $students,
        ])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('StudentList.pdf');
    }

    public static function getStudentListLink($students)
    {
        $pdf = FacadePdf::loadView('students.list', [
            'students' => $students,
        ])->output();

        Storage::disk('public')->put('download/pdf/students.pdf', $pdf);

        $link = Storage::disk('public')->url('download/pdf/students.pdf');

        return response()->json([
            'message' => 'Download Student_url',
            'link' => $link,
        ]);
    }
}
