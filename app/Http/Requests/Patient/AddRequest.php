<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddRequest extends FormRequest
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
        $martial_status = ['Married', 'Single', 'Divorced', 'Widowed'];
        $sex = ['Male', 'Female', 'Choose not to say'];

        return [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:patients',
            'mobile_no' => 'required|unique:patients',
            'birthdate' => 'date',
            'martial_status' => ['required', Rule::in($martial_status)],
            'sex' => ['required', Rule::in($sex)],
            'occupation' => 'required',
            'home_address' => 'required',
        ];
    }
}
