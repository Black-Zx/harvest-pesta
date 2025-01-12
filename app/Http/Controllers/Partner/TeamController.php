<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\User;

class TeamController extends BaseController {
    
    public function showTeamPage()
    {
        User::fixTree();
        
        $params = [
            'tree' => User::with("rank","package")->defaultOrder()->descendantsAndSelf($this->user->id)->toTree()
        ];    
        
        return view('partner.team', $params);
    }
}