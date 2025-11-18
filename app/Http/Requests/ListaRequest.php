<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id' => ['required', 'exists:usuarios,id'],
            'nome' => ['required', 'string', 'max:255', 'min:3'],
            'descricao' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'A lista precisa de um nome.',
        ];
    }
}
