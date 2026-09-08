<?php declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'min:10',
                'max:32',
                'string',
                Rule::unique(Product::class, 'name')
            ],
            'description' => [
                'max:512',
                'string',
            ],
            'price' => [
                'decimal:2',
            ],
        ];
    }
}
