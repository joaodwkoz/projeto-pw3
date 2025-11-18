<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->method() !== 'POST';

        return [
            'nome' => ['required', 'string', 'max:255', 'min:3'],
            'email' => [$isUpdate ? 'sometimes' : 'required', 'email', 'max:255'],
            'senha' => [$isUpdate ? 'nullable' : 'required', 'min:6'],
            'fotoPerfil' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp'],
            'ehAdmin' => ['nullable', 'boolean'],
            'status' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'senha.required' => 'A senha é obrigatória.',
        ];
    }
}
