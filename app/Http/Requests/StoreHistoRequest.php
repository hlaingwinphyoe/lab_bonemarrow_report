<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoRequest extends FormRequest
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
            "aspirate_photos" => 'nullable',
            "aspirate_photos.*" => 'file|max:5000|mimes:png,jpg,jpeg',
            "hospital" => 'required|integer|exists:hospitals,id',
            "name" => 'required|min:3',
            "age" => 'required|numeric|max:100',
            "age_type" => 'required',
            "specimen_type" => "required|min:3",
            "price" => "required|numeric",
            "gender" => 'required',
            "doctor" => 'required|min:3',
            "bio_receive_date" => 'required|date',
            "bio_cut_date" => 'required|date',
            "bio_report_date" => 'required|date',
            "specimen" => 'nullable|min:3',
            "gross" => 'nullable|min:3',
            "description" => 'nullable|min:3',
            "remark" => 'nullable|min:3'
        ];
    }
}
