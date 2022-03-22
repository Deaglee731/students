<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Group;
use App\Models\Student;
use App\Services\FileServices;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Laravel\Telescope\Avatar;

class ProfileController extends Controller
{
    public function index(Student $student)
    {
        $student = Auth::user();
        $groups = Group::pluck('id', 'name')->all();
        $avatar = FileServices::getAvatarLink($student);

        return view('profile.index', [
            'student' => $student,
            'groups' => $groups,
            'avatar' => $avatar,
        ]);
    }

    public function update(Student $student, StudentRequest $request)
    {
        $this->authorize('update', [$student,$request]);

        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home
        ];

        $student->address = $address;
        $student->update($request->validated());

        return redirect(route('profile.index'));
    }

    public function updateAvatar(AvatarRequest $request, Student $student)
    {
        
        $path = $request->file('avatar')->storeAs(
            "avatars/$student->id", 'avatar.jpg'
        );

        Image::make($path)->resize(250, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save("avatars/$student->id/avatar_resize.jpg");

        $student->update(['avatar_path' => $path]);

        return redirect()->route('profile.index');
    }

}
