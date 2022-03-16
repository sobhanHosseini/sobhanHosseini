<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FirstSheetImport3 implements WithStyles,FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithColumnFormatting, WithMapping
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setVisible(false);
        $sheet->getColumnDimension('B')->setVisible(false);
        $sheet->getColumnDimension('C')->setVisible(false);
        $sheet->getColumnDimension('D')->setVisible(false);
        $sheet->getColumnDimension('G')->setVisible(false);
        $sheet->getColumnDimension('H')->setVisible(false);
        $sheet->getColumnDimension('I')->setVisible(false);
        $sheet->getColumnDimension('J')->setVisible(false);
        $sheet->getColumnDimension('K')->setVisible(false);
        $sheet->getColumnDimension('L')->setVisible(false);
        $sheet->getColumnDimension('M')->setVisible(false);
        $sheet->getColumnDimension('N')->setVisible(false);
        $sheet->getColumnDimension('O')->setVisible(false);
        $sheet->getColumnDimension('P')->setVisible(false);
        $sheet->getColumnDimension('Q')->setVisible(false);
        $sheet->getColumnDimension('R')->setVisible(false);
        $sheet->getColumnDimension('S')->setVisible(false);
        $sheet->getColumnDimension('T')->setVisible(false);
        $sheet->getColumnDimension('U')->setVisible(false);
        $sheet->getColumnDimension('V')->setVisible(false);
        $sheet->getColumnDimension('W')->setVisible(false);
    }

    public function map($row): array
    {
        return [
            $row->ID,
            $row->GroupID,
            $row->UserTypeID,
            $row->UserCode,
            $row->UserName,
            $row->Password,
            $row->CurrYear,
            $row->CurrProvinceID,
            $row->CurrCenterID,
            $row->CurrSubCenterID,
            $row->CurrZoneID,
            $row->CurrCityID,
            $row->UserLevelID,
            $row->EncUserLevelID,
            $row->rowguid,
            $row->RowNumbers,
            $row->scuProjectID,
            $row->IsOnline,
            $row->ResetPassword,
            $row->hrsEmployeeID,
            $row->CurrScuCompanyID,
            $row->ExtraID,
            $row->Description,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'GroupID',
            'UserTypeID',
            'UserCode',
            'UserName',
            'Password',
            'CurrYear',
            'CurrProvinceID',
            'CurrCenterID',
            'CurrSubCenterID',
            'CurrZoneID',
            'CurrCityID',
            'UserLevelID',
            'EncUserLevelID',
            'rowguid',
            'RowNumbers',
            'scuProjectID',
            'IsOnline',
            'ResetPassword',
            'hrsEmployeeID',
            'CurrScuCompanyID',
            'ExtraID',
            'Description',
        ];
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function title(): string
    {
        return 'آز-فيزيکي و شيميايي';
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0',
            'C' => '#,##0',
            'D' => NumberFormat::FORMAT_PERCENTAGE_00
        ];
    }
}
