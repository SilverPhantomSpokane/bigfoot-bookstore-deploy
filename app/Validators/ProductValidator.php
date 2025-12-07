<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ProductValidator
{
    public static function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
            'description'   => 'nullable|string',
            // in API we expect image to be a URL string
            'image'         => 'nullable|string',
        ]);

        return $validator->validate();
    }
}
