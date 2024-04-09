<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoRequest extends FormRequest
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
            'nome' => 'required|max:80|min:5|unique:produto,nome',
            'preco' => 'required|decimal:2',
            'ingredientes' => 'required|max:120|min:10',
            'imagem' => 'required'
        ];
    }
    public function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
        }
        public function messages()
        {
            return [
                'nome.required' => 'O campo nome é obrigatório',
                'nome.max' => 'O campo nome deve conter no máximo 80 caracteres',
                'nome.max' => 'O campo nome deve conter no mínimo 5 caracteres',

                'preco.required' => 'Preço é obrigatório',

                'ingredientes.required' => 'O campo ingredientes é obrigatório',
                'ingredientes.max' => 'O campo ingredientes deve conter no máximo 120 caracteres',
                'ingredientes.max' => 'O campo ingredientes deve conter no mínimo 10 caracteres',
                
                'imagem.required' => 'Imagem é obrigatório'
            ];    
}
}