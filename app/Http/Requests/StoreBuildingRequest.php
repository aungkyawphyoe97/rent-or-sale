<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'length' => 'required',
            // 'height' => 'required',
            // 'width' => 'required',
            // 'phone1' =>'regex:/^(09)[0-9]{9}$/',
            // 'ownerName' => 'required',
            // 'address'=>'required',
            // 'price' => 'required',
        ];
    }
}
