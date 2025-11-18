<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvaliacaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id' => ['required', 'integer', 'exists:usuarios,id'],
            'filme_id' => ['required', 'integer', 'exists:filmes,id'],
            'nota' => ['required', 'numeric', 'min:0', 'max:10'],
            'comentario' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'usuario_id.required' => 'O usuário é obrigatório.',
            'filme_id.required' => 'O filme é obrigatório.',
            'nota.required' => 'A nota é obrigatória.',
            'nota.max' => 'A nota máxima é 10.',
        ];
    }
}
