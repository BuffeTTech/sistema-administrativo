<?php

namespace App\Http\Requests\Buffet;

use App\Enums\DocumentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBuffetRequest extends FormRequest
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
            'name' =>['required', 'max:255','string'], 
            'email'=> ['required','string','lowercase', 'email','unique:users,email'],
            'document_type'=>['required','string', Rule::in(array_column(DocumentType::cases(), 'name'))],
            'document'=>['required','string','cpf_ou_cnpj','unique:users,document'],
            'phone1'=>['required','string','celular_com_ddd'],
            'phone2'=>['string','nullable','celular_com_ddd'],
            'trading_name'=>['required','max:255','string'],
            'email_buffet' =>['required', 'max:255','string', 'lowercase', 'email','unique:buffets,email'], 
            'document_buffet'=>['required','string','cnpj','unique:buffets,document'],
            'slug'=>['required','max:20','string', 'lowercase','unique:buffets,slug'],
            'zipcode'=>['required', 'max:255','string'],
            'street' =>['required', 'max:255','string'],
            'neighborhood' =>['required', 'max:255','string'],
            'state' =>['required', 'max:255','string'],
            'city' =>['required', 'max:255','string'],
            'number' =>['required', 'integer'],
            'complement'=>['max:255','string','nullable'],
            'phone1_buffet' =>['required','celular_com_ddd'],
            'phone2_buffet' =>['string','nullable','celular_com_ddd']
            
        ];
    }
}
