<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Group;
use App\Models\Student;
use App\Services\FileServices;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $filename = $request->file('avatar')->getClientOriginalName();
        $student->update(['avatar_path' => $filename]);

        FileServices::updateAvatar($student, $request, $filename);

        return redirect()->route('profile.index');
    }

}
