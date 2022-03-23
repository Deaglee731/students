<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentObserver
{
    public function updated(Student $student)
    {
        if ($student->getAttribute('avatar_path')!= $student->getOriginal('avatar_path')){
            $oldAvatar = $student->getOriginal('avatar_path');
            $oldAvatar_resize = "$oldAvatar"."_resized.jpg";
    
            Storage::disk('avatars')->delete("$student->id/$oldAvatar");
            Storage::disk('avatars')->delete("$student->id/$oldAvatar_resize");
        }
    }

    public function deleted(Student $student)
    {
        $oldAvatar = $student->avatar_path; 
        $oldAvatar_resize = "$oldAvatar"."_resized.jpg";

        Storage::disk('avatars')->delete("$student->id/$oldAvatar");
        Storage::disk('avatars')->delete("$student->id/$oldAvatar_resize");
    }
}
