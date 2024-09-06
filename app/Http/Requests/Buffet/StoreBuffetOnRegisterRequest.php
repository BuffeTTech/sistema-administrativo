<?php

namespace App\Http\Requests\Buffet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreBuffetOnRegisterRequest extends FormRequest
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
            'trading_name' =>['required', 'string', 'max:255',], 
            'email_buffet' =>['required', 'string', 'max:255','email','lowercase','unique:buffets,email'], 
            'document_buffet'=>['required', 'string', 'cnpj','unique:buffets,document'],
            'slug'=>['required','string', 'max:20','lowercase','unique:buffets,slug'],
            'zipcode'=>['required', 'string', 'max:255'],
            'street' =>['required', 'string', 'max:255'],
            'neighborhood' =>['required', 'string', 'max:255'],
            'state' =>['required', 'string', 'max:255'] ,
            'city' =>['required', 'string', 'max:255'],
            'number' =>['required', 'integer'],
            'complement'=>['string', 'max:255','nullable'],
            'phone1_buffet'=>['string', 'required','celular_com_ddd'],//** */
            'phone2_buffet'=>['string', 'celular_com_ddd','nullable']
        ];
    }
}
