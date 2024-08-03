<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BaseRequest;

class CreateRequest extends BaseRequest
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
            'account_number' => 'required|unique:accounts',
            'balance' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'account_number.required' => 'O número da conta é obrigatório.',
            'account_number.max' => 'O número da conta não pode ter mais de 255 caracteres.',
            'account_number.unique' => 'O número da conta já está em uso.',
            'balance.required' => 'O saldo é obrigatório.',
            'balance.numeric' => 'O saldo deve ser um número.',
            'balance.min' => 'O saldo deve ser pelo menos 0.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'account_number' => $this->numero_conta,
            'balance' => $this->saldo
        ]);
    }
}
