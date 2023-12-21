<?php

namespace App\Http\Requests\Representative;

use App\Enums\DocumentType;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRepresentativeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', Representative::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id;
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'document' => ['required', 'string'],
            'document' => [
                'required',
                'string',
                'cpf_ou_cnpj',
                ],
            'document_type' => [
                'required',
                Rule::in(array_column(DocumentType::cases(), 'name'))
            ],
            'phone1' => ['required', 'string', 'celular_com_ddd'],
            'phone2' => ['nullable', 'string', 'celular_com_ddd'],
        ];
    }
}
