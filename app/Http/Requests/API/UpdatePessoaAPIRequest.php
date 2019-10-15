<?php

namespace App\Http\Requests\API;

use App\Models\Pessoa;
use InfyOm\Generator\Request\APIRequest;
use Illuminate\Validation\Rule;

class UpdatePessoaAPIRequest extends APIRequest
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
                Rule::unique('pessoas')->ignore($this->route('pessoa')),
            ],
            'cpf' => [
                'required',
                Rule::unique('pessoas')->ignore($this->route('pessoa')),
            ],
            'data_nascimento' => [
                'nullable',
                'date_format:Y-m-d'

            ]
        ];

        return $rules;
    }

    /**
     * Sobrescrevendo a mensagens retornadas
     *
     * @return void
     */
    public function messages()
    {
        return [
            'data_nascimento.date_format' => 'Verifique a data informada.'
        ];
    }





}
