<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CustomerRedemptionList implements FromView, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    /**
     * @inheritDoc
     */
    public function view(): View
    {
        // get table design at resources/views/exports/cdc
        return view('exports.customers.redemption', [
            'results' => $this->results
        ]);
    }
}
