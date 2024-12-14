<?php

namespace App\Http\Requests;

use App\Models\Wallet;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'from_sheba' => ['required', 'exists:wallets,sheba'],
            'to_sheba' => ['required', 'regex:/^SA[0-9]{21}$/', 'different:from_sheba', 'exists:wallets,sheba'],
            'amount' => ['required', 'numeric', 'min:1', 'integer',
                function ($attribute, $value, $fail) {
                    $wallet = Wallet::where('sheba', request('from_sheba'))->first();
                    if ($wallet && $value > $wallet->balance) {
                        $fail('مبلغ وارد شده بیشتر از موجودی شماره شبا مبدأ است.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'from_sheba.required' => 'شماره شبا مبدأ الزامی است.',
            'from_sheba.exists' => 'شماره شبا مبدأ معتبر نیست.',

            'to_sheba.required' => 'شماره شبا مقصد الزامی است.',
            'to_sheba.regex' => 'شماره شبا مقصد باید با SA شروع شود و شامل ۲۱ رقم باشد.',
            'to_sheba.different' => 'شماره شبا مقصد نمی‌تواند با شماره شبا مبدأ یکسان باشد.',
            'to_sheba.exists' => 'شماره شبا مقصد معتبر نیست.',

            'amount.required' => 'مبلغ انتقال الزامی است.',
            'amount.numeric' => 'مبلغ انتقال باید یک عدد باشد.',
            'amount.integer' => 'مبلغ انتقال باید عدد صحیح باشد.',
            'amount.min' => 'مبلغ انتقال باید حداقل ۱ باشد.',
            'amount.max' => 'مبلغ انتقال نمی‌تواند بیشتر از موجودی شبا مبدأ باشد.',
        ];
    }
}
