<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
class DataExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromView,WithColumnWidths
{
    protected $data;
    protected $headerList;

    function __construct($data,$headerList) {
        $this->data = $data;
        $this->header_list = $headerList;
    }

    public function view(): View
    {
        return view('data', [
            'data' => $this->data,
            'header'=>$this->header_list
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 60,  
            'C' => 65,
            'D' => 65,
            'E' => 55,
            'F' => 35,
            'G' => 35,
            'H' => 35,
            'I' => 35,
            'J' => 35,
            'K' => 80,            
        ];
    }
}

