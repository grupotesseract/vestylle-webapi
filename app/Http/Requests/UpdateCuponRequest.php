<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cupon;
use Illuminate\Validation\Rule;

class UpdateCuponRequest extends FormRequest
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
        $rules = Cupon::$rules;

        return array_merge($rules, [
            'codigo_amigavel' => [
                'nullable',
                'required_without:aparece_listagem',
                Rule::unique('cupons')->ignore($this->route('cupon')),
            ]
        ]);
    }

    /**
     * Incluindo mensagem de validacao custom
     *
     * @return void
     */
    public function messages()
    {
        return Cupon::$msgValidacaoAmigavel;
    }

}
