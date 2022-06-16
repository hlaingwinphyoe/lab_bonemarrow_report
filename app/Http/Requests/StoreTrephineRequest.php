<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrephineRequest extends FormRequest
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
            "trephine_photos" => 'nullable',
            "trephine_photos.*" => 'file|max:5000|mimes:png,jpg,jpeg',
            "hospital"  => "required|integer|exists:hospitals,id",
            "sc_date" => 'required|date',
            "lab_access" => 'required|numeric',
            "patient_name" => 'required|min:3',
            "age" => 'required|numeric|max:100',
            "age_type" => 'required',
            "specimen_type" => "required|min:3",
            "price" => "required|numeric",
            "gender" => 'required',
            "contact_detail" => 'nullable|min:3',
            "physician_name" => 'required|min:3',
            "doctor" => 'required|min:3',
            "clinical_history" => 'nullable|min:3',
            "bmexamination" => 'nullable|min:3',
            "pro_perform" => 'required',
            "anatomic_site_trephine"  => 'nullable|min:3',
            "biopsy_core"  => 'nullable|min:3',
            "ade_macro_appearance"  => 'nullable|min:3',
            "percentage_cellularity"  => 'nullable|min:3',
            "bone_architecture"  => 'nullable|min:3',
            "path"  => "nullable|min:3",
            "tre_number"  => 'nullable',
            "erythroid"  => 'nullable|min:3',
            "myeloid"  => 'nullable|min:3',
            "megaka"  => 'nullable|min:3',
            "lymphoid"  => 'nullable|min:3',
            "plasma_cell"  => 'nullable|min:3',
            "macrophages"  => 'nullable|min:3',
            "abnormal_cell"  => 'nullable|min:3',
            "reticulin_stain"  => 'nullable|min:3',
            "immunohistochemistry"  => 'nullable|min:3',
            "histochemistry"  => 'nullable|min:3',
            "investigation"  => 'nullable|min:3',
            "conclusion"  => 'nullable|min:3',
            "disease_code"  => 'nullable|min:3',
        ];
    }
}
