<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => Str::lower(trim((string) $this->input('email'))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'string',
                'required',
                'min:8',
                'max:24',
                Rule::unique(User::class, 'username'),
            ],
            'email' => [
                'string',
                'required',
                'email',
                'max:255',
                Rule::unique(User::class, 'email'),
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(15)
                ->max(64)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            ],
        ];
    }
}
