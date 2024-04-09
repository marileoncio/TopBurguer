<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteRequest extends FormRequest
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
            'nome' => 'required|min:5|max:120',
            'telefone' => 'required|max:11|min:10',
            'endereco' => 'required',
            'email' => 'unique:clientes,email|required|email|max:120',
            'cpf' => 'unique:clientes,cpf|required|max:11|min:11',
            'password' => 'required',
            'imagem' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
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
            'nome.min' => 'O campo nome deve conter no mínimo 5 caracteres',
            'nome.max' => 'O campo nome deve conter no máximo 120 caracteres',

            'telefone.required' => 'telefone obrigatório',
            'telefone.max' => 'telefone deve conter no máximo 11 caracteres',
            'telefone.min' => 'telefone deve conter no mínimo 10 caracteres',

            'email.required' => 'E-mail obrigátorio',
            'email.max' => 'E-mail deve conter no máximo 120 caracteres',
            'email.unique' => 'O campo e-mail deve ser único',

            'cpf' => 'O campo CPF é obrigatório',
            'cpf.max' => 'O campo cpf deve conter no máximo 11 caracteres',
            'cpf.min' => 'O campo cpf deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'O campo cpf deve ser único',

            'password.required' => 'password é obrigátorio',

            'imagem.required' => 'imagem obrigatória',

            'endereco.required' => 'endereço obrigatório'
        ];
    }
}
