<?php
namespace App\Imports;
use App\Models\Import;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersEarning implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Import([
            'week'        => Carbon::now()->weekOfYear,
            'username'    => $row['Username'],
            'point'       => $row['Casino point'],
            'casino_name' => $row['Casino Name'],
            'imported_by' => Auth::user()->id,
            'created_at'  => Carbon::now()
         ]);
    }
}