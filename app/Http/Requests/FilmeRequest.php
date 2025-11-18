<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'ano' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'classificacao_id' => ['required', 'exists:classificacoes,id'],
            'capa' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
            'generos' => ['nullable', 'array'],
            'generos.*' => ['integer', 'exists:generos,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'ano.required' => 'O ano é obrigatório.',
        ];
    }
}
