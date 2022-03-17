<?php

namespace App\Http\Controllers\Auth;

use App\Events\CreatedStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = Group::pluck('id', 'name')->all();
        $roles = RoleDictionary::getDictionary();

        return view('auth.register', [
            'groups' => $groups,
            'roles' => $roles,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterStudentRequest $request)
    {
        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home
        ];

        $user = Student::create($request->validated());
        $user->address = $address;

        event(new CreatedStudent($user));

        $user->password = bcrypt($user->password);
        $user->save();

        Auth::login($user);
        
        return redirect(RouteServiceProvider::HOME);
    }
}
