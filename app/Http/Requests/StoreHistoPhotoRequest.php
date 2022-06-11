<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoPhotoRequest extends FormRequest
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
            "histo_id" => "required|exists:histos,id",
            "histo_photos" => 'required',
            "histo_photos.*" => 'file|max:5000|mimes:png,jpg,jpeg'
        ];
    }
}
