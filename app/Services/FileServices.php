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
            if (Storage::disk('avatars')->exists("$student->id/$student->avatar_path"."_resized.jpg")){
                return Storage::disk('avatars')->url("$student->id/$student->avatar_path"."_resized.jpg");
            }

            elseif (Storage::disk('avatars')->exists("$student->id/$student->avatar_path")){
                return Storage::disk('avatars')->url("$student->id/$student->avatar_path");
            }
            
        }
        else{
            return Storage::disk('avatars')->url("default.jpg");
        }
    }

    public static function updateAvatar($student , $request, $file) {
        
        if (Storage::disk('avatars')->exists("$student->id/$file")){
            if (Storage::disk('avatars')->exists("$student->id/$file"."_resized.jpg")){
                return true;
            }
            else {
                Image::make("avatars/$student->id/$file")->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("avatars/$student->id/$file"."_resized.jpg");
            }
        }
        else{
            $path = $request->file('avatar')->storeAs(
                "avatars/$student->id", $file
            );
            
            Image::make($path)->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save("avatars/$student->id/$file"."_resized.jpg");
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
