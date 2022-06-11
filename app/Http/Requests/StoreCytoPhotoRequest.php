<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCytoPhotoRequest extends FormRequest
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
            "cyto_id" => "required|exists:cytos,id",
            "cyto_photos" => 'required',
            "cyto_photos.*" => 'file|max:5000|mimes:png,jpg,jpeg'
        ];
    }
}
