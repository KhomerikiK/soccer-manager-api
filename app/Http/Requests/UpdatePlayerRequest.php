<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'position_id' => 'exists:positions,id',
            'country_id' => 'exists:countries,id',
            'first_name' => 'string',
            'last_name' => 'string',
            'age' => 'integer|min:18|max:40',
            'market_price' => 'integer|min:0',
        ];
    }
}
