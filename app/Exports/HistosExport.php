<?php

namespace App\Exports;

use App\Models\Histo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class HistosExport implements FromCollection,WithHeadings,WithMapping,WithEvents
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
            "Specimen",
            "Gross",
            "Microscopic",
            "Remark"
        ];
    }

    public function collection()
    {
        return Histo::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:Q1')
                    ->getFont()
                    ->setSize(13)
                    ->setBold(true);
            },
        ];
    }

    public function map($histo) : array{
        return [
            $histo->hospital->name,
            $histo->name,
            $histo->year,
            $histo->month,
            $histo->day,
            $histo->gender,
            $histo->doctor,
            $histo->specimenType->name,
            $histo->specimenType->price,
            $histo->bio_receive_date,
            $histo->bio_cut_date,
            $histo->bio_report_date,
            $histo->specimen,
            $histo->gross,
            $histo->description,
            $histo->remark,
        ];
    }

}
