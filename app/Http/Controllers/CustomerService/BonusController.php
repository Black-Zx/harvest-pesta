<?php

namespace App\Http\Controllers\CustomerService;

use App\Http\Controllers\CustomerService\BaseController;
use Illuminate\Http\Request;
use App\Models\BonusPool;

class BonusController extends BaseController {

    public function showBonusPoolList()
    {
        $bonus_pools = BonusPool::get();

        $params = [
            'bonus_pools' => $bonus_pools,
        ];

        return view('cs.bonusPool', $params);
    }  

    public function updateBonusPool(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'amount' => 'required|integer',
            'name' => 'required'
        ]);

        $result = $this->bonusPoolRepo->change($request->input(), "Rank");
        
        return redirect()->back()->withSuccess('Updated.');
    }

}