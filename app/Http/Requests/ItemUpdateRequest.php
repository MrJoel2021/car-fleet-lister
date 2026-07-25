<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{
    /**
     * Allow this request to run.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for updating a vehicle.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // Product must be text between 3 and 25 characters
            'product' => ['required', 'string', 'min:3', 'max:25'],

            // Category must be text between 3 and 25 characters
            'category' => ['required', 'string', 'min:3', 'max:25'],

            // Quantity must be a number between 1 and 1000
            'quantity' => ['required', 'integer', 'between:1,1000'],

            // Price must be a number between 1 and 500
            'price' => ['required', 'integer', 'between:1,500'],
        ];
    }
}