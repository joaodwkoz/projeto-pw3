<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required' , 'string' , 'max:255' , 'min:10'], 

            'email' => ['required' , 'string' , 'email' , 'max:255', 'unique:users'],

            'password' => ['required' , 'string' , 'min:8' , 'confirmed'],
        ];
    }

    public function messages(): array {
        return [ 
            'name.required' => 'O nome é obrigatório.' ,
            'email.required' => 'O email é obrigatório.' ,
            'email.unique' => 'Esse email já está cadastrado. ' ,
            'password.required' => 'A senha é obrigatória. ' ,
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.' ,
            'password.confirmed' => 'A confirmação de senha não corresponde. ' ,
        ];
    }
}
