<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberFormRequest extends FormRequest
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
        $rules['name'] = 'required|min:4|max:50';
        $rules['password'] = 'required|between:8,16';
        $rules['confirm_password'] = 'required|same:password';

        switch ($this->method()) {
            case 'POST':
                $rules['email'] = 'required|email|unique:users,email';
                break;
            case 'PATCH':
                $rules['email'] = 'required|email|unique:users,email,' . $this->user->id;
                break;
        }

        return $rules;
    }
}
