<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'pais' => ['nullable', 'string', 'max:255'],
            'contato' => ['nullable', 'string', 'max:255'],
            'whatsapp_wechat' => ['nullable', 'string', 'max:255'],
            'site' => ['nullable', 'url', 'max:255'],
            'observacoes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do fornecedor é obrigatório.',
            'site.url' => 'Informe uma URL válida (ex: https://exemplo.com).',
        ];
    }
}