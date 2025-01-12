<?php
namespace App\Imports;
use App\Models\ImportDirectBonus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersDirectPoint implements ToModel, WithHeadingRow
{
    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportDirectBonus([
            'week'        => Carbon::now()->weekOfYear,
            'username'    => $row['Username'],
            'point'       => $row['Point'],
            'month'       => $this->month,
            'year'        => $this->year,
            'imported_by' => Auth::user()->id,
            'created_at'  => Carbon::now()
         ]);
    }
}