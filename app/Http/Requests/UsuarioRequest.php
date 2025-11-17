<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nome' => ['required' , 'string', 'max:100' , 'min:3'],
            'email' => ['required' , 'string', 'email', 'max:255']
        ];
    }

    public function messages(): array {
        return [
            'nome.required' => 'O campo nome é obrigatório.' ,
            'nome.min' => 'O Nome deve ter no mínimo :min caracteres.' ,

            'email.required' => 'O campo email é obrigatório.' ,
            'email.email' => 'O e-mail fornecido não é válido.'
        ];
    }
}
