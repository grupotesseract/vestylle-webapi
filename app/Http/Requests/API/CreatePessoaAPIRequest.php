<?php

namespace App\Http\Requests\API;

use App\Models\Pessoa;
use InfyOm\Generator\Request\APIRequest;
use Illuminate\Validation\Rule;
use App\Rules\CPFValido;

class CreatePessoaAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => [
                'required',
                'unique:pessoas',
                new CPFValido
            ],
            'cpf' => 'unique:pessoas',
        ];

        return $rules;
    }
}
