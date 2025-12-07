<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    // Allow access to all users
    public function authorize(): bool
    {
        return true;
    }

    // Validation rules
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
