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
        return Gate::authorize('update',$this->route('cyto'));
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
            "age" => 'required|numeric|max:100',
            "age_type" => 'required',
            "gender" => 'required',
            "specimen_type" => "required|min:3",
            "price" => "required|numeric",
            "doctor" => 'required|min:3',
            "bio_receive_date" => 'required|date',
            "bio_cut_date" => 'required|date',
            "bio_report_date" => 'required|date',
            "specimen" => 'nullable|min:3',
            "gross" => 'nullable|min:3',
            "cyto_diagnosis" => 'nullable|min:3',
            "remark" => 'nullable|min:3'
        ];
    }
}
