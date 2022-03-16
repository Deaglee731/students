<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Mail\PasswordSet;
use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

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

        return view('auth.register', [
            'groups' => $groups
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
        $password = $user->password;
        $user->address = $address;
        $user->password = bcrypt($user->password);
        $user->save();

        event(new Registered($user));

        Auth::login($user);
        
        Mail::to($request->email)->send(new PasswordSet($user, $password));
        
        return redirect(RouteServiceProvider::HOME);
    }
}
