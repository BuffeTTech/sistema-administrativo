<?php

namespace App\Http\Requests\Commercial;

use App\Enums\DocumentType;
use App\Models\Commercial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommercialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', Commercial::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'document' => [
                'required',
                'string',
                'cpf_ou_cnpj'
            ],
            'document_type' => [
                'required',
                Rule::in(array_column(DocumentType::cases(), 'name'))
            ],
            'phone1' => ['required', 'string', 'celular_com_ddd'],
            'phone2' => ['nullable', 'string', 'celular_com_ddd']
        ];
    }
}
