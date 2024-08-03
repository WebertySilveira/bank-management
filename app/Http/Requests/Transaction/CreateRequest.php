<?php

namespace App\Http\Requests\Transaction;

use App\Http\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required',
            'account_number' => 'required',
            'value' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'O tipo da transação é obrigatório.',
            'account_number.required' => 'O número da conta é obrigatório.',
            'value.required' => 'O valor é obrigatório.',
            'value.numeric' => 'O valor deve ser um número.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'type' => $this->forma_pagamento,
            'account_number' => $this->numero_conta,
            'value' => $this->valor
        ]);
    }
}
