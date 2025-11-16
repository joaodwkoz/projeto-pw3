<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'txProduto'=>['required','min:3']
        ];
    }

    public function messages() {
        return [
            'txProduto.required' => 'O campo produto é obrigatório',
            'txProduto.min' => 'O campo produto deve ter no mínimo :min caracteres'
        ];
    }
}
