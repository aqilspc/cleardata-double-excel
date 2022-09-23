<?php

namespace App\Exports;

use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataExport implements FromView
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
}

