<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>"required|string|max:255",
            'email'=>'required|string|unique:users,email|max:255',
            'phone'=>'required|string|max:11|unique:users,phone',
          
            'password'=>'required|min:8|string'
        ];
    }
}
