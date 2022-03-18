<?php

namespace App\Http\Requests;

use App\Models\Dictionaries\RoleDictionary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StudentRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'group_id' => 'required',
            'city' => 'required',
            'email' => 'required',
            'street' => 'required',
            'home' => 'required',
            'birthday' => 'required',
            'role_id' => ['required', Rule::in(RoleDictionary::getRange())],
        ];
    }
}
