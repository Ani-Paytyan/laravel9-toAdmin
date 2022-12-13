<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniqueItemMacUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'mac' => 'unique:App\Models\UniqueItem,mac',
        ];
    }
}
