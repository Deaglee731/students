<?php

namespace App\Http\Requests;

use App\Models\Dictionaries\RoleDictionary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisterStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'group_id' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'city' => 'required',
            'street' => 'required',
            'home' => 'required',
            'birthday' => 'required',
            'role_id' => ['required', Rule::in(RoleDictionary::getRange())],
        ];
    }
}
