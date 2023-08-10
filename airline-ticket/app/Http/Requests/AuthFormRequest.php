<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class AuthFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'userName' => 'string',
            'password' => 'string',
        ];
    }
}
