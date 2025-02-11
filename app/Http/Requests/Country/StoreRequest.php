<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            "name" => ['required', 'string', "max:255"],
            "google" => ['string'],
            "shop" => ['integer'],
            "facebook" => ['string'],
            "analytics" => ['string'],
            "active" => ['bool'],
            "facebook_daily_budget" => ["integer"],
            "google_daily_budget" => ["integer"],
            "facebook_budget_currency" => ["string"],
            "google_budget_currency" => ["string"],
            "google_additional_campaign" => ["string"],
            "result-summary" => ["bool"]
        ];
    }
}
