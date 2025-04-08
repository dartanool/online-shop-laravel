<?php

namespace App\Http\Requests;

use App\DTO\CreateOrderDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'comment' => 'required',
            'address' => 'required',
        ];
    }

    public function getDto(): CreateOrderDTO
    {

        return new CreateOrderDTO(
            $this->validated()['contact_name'],
            $this->validated()['contact_phone'],
            $this->validated()['comment'],
            $this->validated()['address']
        );
    }
}
//'contact_name' => 'required|string|max:255',
//            'contact_phone' => 'required|regex:/^\+?\d{10,15}$/',
//            'comment' => 'required|string|max:255',
//            'address' => 'required|string|max:255',
