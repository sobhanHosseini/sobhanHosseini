<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class testImport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithColumnFormatting, WithMapping, WithEvents
{
    protected $rows;
    protected $count = 0;
    protected $countRow = 0;

    public function __construct(array $rows)
    {
        $this->countRow = 0;
        $this->countRow = count($rows);
        $this->rows = $rows;
    }

    public function map($row): array
    {
        return [
            $row->CenterCode,
            $row->CenterName,
            $row->SubCenterCode,
            $row->SubCenterName,
            $row->ZoneCode,
            $row->ZoneName,
            $row->CityCode,
            $row->CityName,
            $row->PlaceCode,
            $row->PlaceName,
            $row->Longitude,
            $row->Latitude,
//            $row->ItemDetailName,
        ];
    }

    public function headings(): array
    {
        $data = [];
        $this->count = 0;
        $tmp = ['کد شرکت', 'نام شرکت', 'کد زير شرکت', 'نام زیر شرکت', 'کد امور', 'نام امور', 'کد شهر', 'نام شهر', 'کد محل', 'نام محل', 'Longitude', 'Latitude'];
        foreach ($tmp as $value) {
            ++$this->count;
            array_push($data, $value);
        }
//        $lastIndex = $data[count($this->rows)];

        $docData = DB::table('mis.MIS_DocDefs', 'dd')
            ->select('mi.ItemDetailName', 'dd.DocDefName', 'mi.ItemString')
            ->leftJoin('mis.MIS_DocDefLines as dl', 'dd.ID', 'dl.DocDefID')
            ->leftJoin('mis.MIS_Item as mi', 'mi.ID', 'dl.MIS_ItemID')
            ->where('dd.IsSystem', 0)
            ->where('dd.DocDefCode', $this->rows[0]->DocDefCode)
            ->get()->toArray();

        foreach ($docData as $value) {
            if ($value->ItemDetailName) {
                ++$this->count;
                array_push($data, $value->ItemDetailName . ' - ' . $value->ItemString);
            }
        }

        return [
            [
                'جدول ' . $docData[0]->DocDefName
            ],
            $data
        ];
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function title(): string
    {
        return 'sheet';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellIndex = $this->getColumn($this->count);
                $cellRangeHead = 'A1:' . $cellIndex . '1'; // All headers
                $cellRangeCell = 'A2:' . $cellIndex . $this->countRow + 2;
                $event->sheet->getDelegate()->mergeCells($cellRangeHead);
                $event->sheet->getDelegate()->getStyle($cellRangeHead)->getAlignment()->setHorizontal(Alignment::VERTICAL_JUSTIFY);
                $event->sheet->getDelegate()->getStyle($cellRangeHead)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('D9D9D9');
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getDelegate()->freezePaneByColumnAndRow('11','3');

                $event->sheet->getDelegate()->setAutoFilter($cellRangeCell);
                $event->sheet->getDelegate()->getStyle($cellRangeCell)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
                $event->sheet->getDelegate()->getStyle('A2:' . $cellIndex . '2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('8DB4E2');
                $event->sheet->getStyle($cellRangeCell)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ]
                ]);
            }];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,###0',
            'C' => '#,###0',
            'D' => NumberFormat::FORMAT_PERCENTAGE_00
        ];
    }

    public function getColumn($index)
    {

        $countAplpha = 0;
        $alpha = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        ];

        $tmp = $index;

        if ($tmp <= 26) {
            return $alpha[$tmp - 1];
        } else {
            while ($tmp > 26) {
                $tmp = $tmp - 26;
                $countAplpha++;
            }
            return $alpha[$countAplpha - 1] . $alpha[$tmp - 1];
        }

    }
}
