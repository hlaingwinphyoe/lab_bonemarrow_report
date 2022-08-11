<?php

namespace App\Exports;

use App\Models\Trephine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TrephinesExport implements FromCollection,WithHeadings,WithMapping,WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings():array{
        return[
            "Due Date",
            "Hospital",
            "Patient Name",
            "Year",
            "Month",
            "Day",
            "Gender",
            "Refer Doctor",
            "Procedure",
            "Specimen Type",
            "Price",
            "Contact Detail",
            "Laboratory Accession Number",
            "Physician Name",
            "Clinical History",
            "Indication for bone marrow examination",
            "Anatomic site of trephine/biopsy",
            "Aggregate Length Of Biopsy Core",
            "Adequacy And Macroscopic Appearance Of Core",
            "Percentage And Pattern Of Cellularity",
            "Bone Architecture",
            "Location",
            "Trephine Number",
            "Morphology And Pattern of Differentiation For Erythroid",
            "Myeloid Lineages",
            "Megakaryocytic Lineages",
            "Lymphoid Cells",
            "Plasma cells",
            "Macrophages",
            "Abnormal cells and/or infiltrates",
            "Reticulin Stain",
            "Immunohistochemistry",
            "Histochemistry",
            "Other investigations",
            "Conclusion",
            "Disease code",
        ];
    }

    public function collection()
    {
        return Trephine::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:AJ1')
                    ->getFont()
                    ->setSize(13)
                    ->setBold(true);
            },
        ];
    }

    public function map($trephine) : array{
        return [
            $trephine->sc_date,
            $trephine->hospital->name,
            $trephine->patient_name,
            $trephine->year,
            $trephine->month,
            $trephine->day,
            $trephine->gender,
            $trephine->doctor,
            $trephine->pro_perform,
            $trephine->specimenType->name,
            $trephine->specimenType->price,
            $trephine->contact_detail,
            $trephine->lab_access,
            $trephine->physician_name,
            $trephine->clinical_history,
            $trephine->bmexamination,
            $trephine->anatomic_site_trephine,
            $trephine->biopsy_core,
            $trephine->ade_macro_appearance,
            $trephine->percentage_cellularity,
            $trephine->bone_architecture,
            $trephine->path,
            $trephine->tre_number,
            $trephine->erythroid,
            $trephine->myeloid,
            $trephine->megaka,
            $trephine->lymphoid,
            $trephine->plasma_cell,
            $trephine->macrophages,
            $trephine->abnormal_cell,
            $trephine->reticulin_stain,
            $trephine->immunohistochemistry,
            $trephine->histochemistry,
            $trephine->investigation,
            $trephine->conclusion,
            $trephine->disease_code,
        ];
    }
}
