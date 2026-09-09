<?php declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListProductsRequest extends FormRequest
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
            'page' => ['integer'],
            'name' => ['string'],
            'minPrice' => ['decimal:2'],
            'maxPrice' => ['decimal:2'],
            'sort' => ['string'],
            'sortOrder' => ['string'],
        ];
    }
}
