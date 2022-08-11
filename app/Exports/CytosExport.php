<?php

namespace App\Exports;

use App\Models\Cyto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class CytosExport implements FromCollection,WithHeadings,WithMapping,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "Hospital",
            "Patient Name",
            "Year",
            "Month",
            "Day",
            "Gender",
            "Refer Doctor",
            "Specimen Type",
            "Price",
            "Received Date",
            "Cutting Date",
            "Report Date",
            "Morphology",
            "Cytological Diagnosis",
        ];
    }

    public function collection()
    {
        return Cyto::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:O1')
                    ->getFont()
                    ->setSize(13)
                    ->setBold(true);
            },
        ];
    }

    public function map($cyto) : array{
        return [
            $cyto->hospital->name,
            $cyto->name,
            $cyto->year,
            $cyto->month,
            $cyto->day,
            $cyto->gender,
            $cyto->doctor,
            $cyto->specimenType->name,
            $cyto->specimenType->price,
            $cyto->bio_receive_date,
            $cyto->bio_cut_date,
            $cyto->bio_report_date,
            $cyto->morphology,
            $cyto->cyto_diagnosis,
        ];
    }
}
