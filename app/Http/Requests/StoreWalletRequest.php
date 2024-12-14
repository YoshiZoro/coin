<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
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
            'sheba' => ['required', 'string', 'regex:/^SA[0-9]{21}$/'],
            'balance' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'sheba.required' => 'وارد کردن شماره شبا الزامی است.',
            'sheba.string' => 'شماره شبا باید به صورت متنی وارد شود.',
            'sheba.regex' => 'شماره شبا باید با "SA" شروع شود و شامل 21 رقم عددی باشد.',
            'balance.required' => 'وارد کردن مبلغ اولیه الزامی است.',
            'balance.numeric' => 'مبلغ اولیه باید یک عدد باشد.',
            'balance.min' => 'مبلغ اولیه نمی‌تواند کمتر از صفر باشد.',
        ];
    }
}
