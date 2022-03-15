<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Student $student)
    {
        $student = Auth::user();
        $groups = Group::pluck('id', 'name')->all();

        return view('profile.index', [
            'student' => $student,
            'groups' => $groups
        ]);
    }

    public function update(Student $student, StudentRequest $request)
    {
        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home
        ];
        
        $student->address = $address;
        $student->update($request->validated());

        return redirect(route('profile.index'));
    }
}
