<?php

namespace App\Http\Controllers\CustomerService;

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerService\BaseController;
use App\Models\BankDetail;
use App\Models\Bank;

class BankController extends BaseController {

    public function showBankForm() 
    {

        $bankDetail = BankDetail::first();
        $banks = Bank::all();

        $params = [
            'bankDetail' => $bankDetail,
            'banks' => $banks
        ];

        return view('cs.bank', $params);
    }

    public function uploadBankDetail(Request $request)
    {
        $request->validate([
            // 'bank_id' => 'required',
            'bank_account' => 'required',
            // 'bank_account_name' => 'required',
        ]);

        $result = $this->bankRepo->change($request->input());

        return redirect()->back()->withSuccess('Great! You have Successfully loggedin');
    }
    
}