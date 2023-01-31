<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            // 下記はitemsテーブルのcontrol_numberは重複しないようにしている
            'control_number' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'lower_count' => 'required|numeric'
        ];
    }
}
