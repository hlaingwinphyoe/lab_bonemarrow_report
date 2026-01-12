<?php

namespace App\Exports;

use App\Models\Aspirate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class AspiratesExport implements FromCollection,WithHeadings,WithMapping,WithEvents
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
            "Anatomic site of aspirate/biopsy",
            "Ease/difficulty of aspiration",
            "Blood count",
            "Blood smear description and diagnostic conclusion",
            "Cellularity of particles and cell trails",
            "Nucleated differential cell count",
            "Total number of cells counted",
            "Myeloid:erythroid ratio",
            "Erythropoiesis",
            "Myelopoiesis",
            "Megakaryocytes",
            "Lymphocytes",
            "Plasma cells",
            "Other haemopoietic cells",
            "Abnormal cells",
            "Iron Stain",
            "Cytochemistry",
            "Other investigations",
            "Summary of flow cytometry findings",
            "Conclusion",
            "WHO classification",
            "Disease code",
        ];
    }

    public function collection()
    {
        return Aspirate::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:AL1')
                    ->getFont()
                    ->setSize(13)
                    ->setBold(true);
            },
        ];
    }

    public function map($aspirate) : array{
        return [
            $aspirate->sc_date,
            $aspirate->hospital->name,
            $aspirate->patient_name,
            $aspirate->year,
            $aspirate->month,
            $aspirate->day,
            $aspirate->gender,
            $aspirate->doctor,
            $aspirate->pro_perform,
            $aspirate->specimenType->name,
            $aspirate->specimenType->price,
            $aspirate->contact_detail,
            $aspirate->lab_access,
            $aspirate->physician_name,
            $aspirate->clinical_history,
            $aspirate->bmexamination,
            $aspirate->anatomic_site_aspirate,
            $aspirate->ease_diff_aspirate,
            $aspirate->blood_count,
            $aspirate->blood_smear,
            $aspirate->cellular_particles,
            $aspirate->nucleated_differential,
            $aspirate->total_cell_count,
            $aspirate->myeloid,
            $aspirate->erythropoiesis,
            $aspirate->myelopoiesis,
            $aspirate->megakaryocytes,
            $aspirate->lymphocytes,
            $aspirate->plasma_cell,
            $aspirate->haemopoietic_cell,
            $aspirate->abnormal_cell,
            $aspirate->iron_stain,
            $aspirate->cytochemistry,
            $aspirate->investigation,
            $aspirate->flow_cytometry,
            $aspirate->conclusion,
            $aspirate->classification,
            $aspirate->disease_code,
        ];
    }
}
