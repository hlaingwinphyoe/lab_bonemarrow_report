<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCytoRequest extends FormRequest
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
            "hospital" => 'required|integer|exists:hospitals,id',
            "name" => 'required|min:3',
            "year" => "required|integer|min:0",
            "month" => "required|integer|min:0",
            "day" => "required|integer|min:0",
            "gender" => 'required',
            "doctor" => 'required|min:3',
            "bio_receive_date" => 'nullable|date',
            "bio_cut_date" => 'nullable|date',
            "bio_report_date" => 'nullable|date',
            "morphology" => 'nullable|min:3',
            "cyto_diagnosis" => 'nullable|min:3',
            "specimen_type" => 'required|integer|exists:specimen_types,id'
        ];
    }
}
