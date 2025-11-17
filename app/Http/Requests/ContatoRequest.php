<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // Regra adicionada/confirmada
            'assunto' => ['required', 'string'], 
            'mensagem' => ['required', 'string', 'min:10', 'max:200'],
        ];
    }

    public function messages(): array {
        return [
            // Corrigido 'name.required' para 'nome.required' e adicionadas mensagens
            'nome.required' => 'O campo Nome é obrigatório.', 
            'nome.min' => 'O Nome deve ter no mínimo :min caracteres.',
            
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'O e-mail fornecido não é válido.',
            
            'assunto.required' => 'O campo Assunto é obrigatório.',
            
            'mensagem.required' => 'O campo Mensagem é obrigatório.',
            'mensagem.min' => 'A Mensagem deve ter no mínimo :min caracteres.',
            'mensagem.max' => 'A Mensagem deve ter no máximo :max caracteres.',
        ];
    }
}