<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\IncrDecrAmountDTO;

class ProductRequest extends FormRequest
{

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
            'product_id' => 'required|int',
        ];
    }
    public function getDto() : IncrDecrAmountDTO
    {
        return new IncrDecrAmountDTO(
            $this->validated()['product_id'],
        );
    }
}
