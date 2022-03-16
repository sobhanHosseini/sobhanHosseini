<?php

namespace App\Exports;

use App\Models\Info;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;

class UsersExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        /* $a = Info::groupBy('name')->selectRaw('name, array_to_json("array_agg"(email)) as email')->get();
        for ($i = 0; $i < count($a); $i++) {
            $a[$i]['email'] = json_decode($a[$i]['email']);
        } */
        return Info::all();
    }

    public function map($users): array
    {

        return [
            [
                //  $users->email[0],
            ]
        ];
    }
    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->mergeCells($cellRange);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(15);
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $a = Info::groupBy('name')->selectRaw('name, array_to_json("array_agg"(email)) as email')->get();
                $col = count($a);
                
                /**
                 * convert email to array
                 */
                for ($c = 0; $c < count($a); $c++) {
                    $a[$c]['email'] = json_decode($a[$c]['email']);
                }
                /*
                *$i= column , $j=row , $l=count array , $k=count number in email
                */
                for ($i = 1, $l = 0; $l < $col; $i++, $l++) {

                    $row = count($a[$l]['email']);
                    for ($j = 3, $k = 0; $k < $row; $j++, $k++) {
                        $event->sheet->getDelegate()->setCellValueByColumnAndRow($i, $j, $a[$l]['email'][$k]);
                    }
                }
            },
        ];
    }

    public function headings(): array
    {
        $a = Info::groupBy('name')->selectRaw('name, array_to_json("array_agg"(email)) as email')->get();
        $b = [];
        $c = [];
        foreach ($a as $ab) {
            array_push($b, $ab->name);
            array_push($c, $ab->email);
        }

        return [
            [
                'آبفای کشور',
            ],
            $b,
        ];
    }
}
