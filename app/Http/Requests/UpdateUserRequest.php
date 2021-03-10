<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user')->id;

        return [

            'name' => 'required|string|max:191',
            'email' => [
                'required', 'email', 'max:191',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'required|min:8'
            
        ];
    }
}
