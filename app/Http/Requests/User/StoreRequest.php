<?php
declare(strict_types=1);
namespace App\Http\Requests\User;

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
            'password' => ['required', 'min:8', "max:50", 'string', "confirmed"],
            'name' => ['required', 'min:3', "max:50", 'string'],
            'email' => ['required', 'min:8', "max:50", 'email', "unique:users,email"],
        ];
    }
}
