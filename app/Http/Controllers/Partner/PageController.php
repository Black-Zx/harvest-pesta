<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Partner\BaseController;
use App\Models\BonusPool;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Banner;

class PageController extends BaseController {

    public function dashboard()
    {
        $now = Carbon::now();
        $totalGroupSales = 0;
        $weeklyGroupSales = 0;
        $banner = Banner::first();

        $users = User::defaultOrder()->descendantsAndSelf($this->user->id);
        foreach ($users as $key => $user) {
            $totalGroupSales += $user->bonuses()->EarnedBonus(0);
            $weeklyGroupSales += $user->bonuses()->EarnedBonus($now->weekOfYear);
        }
        
        $totalMember = User::RankCount(1);
        $totalAgent = User::RankCount(2);
        $totalMaster = User::RankCount(3);
        $totalShare = User::RankCount(4);

        $masterAgentRacing = BonusPool::where('type', 1)->get();
        $managerRacing = BonusPool::where('type', 2)->get();

        $params = [
            'totalGroupSales' => $totalGroupSales,
            'weeklyGroupSales' => $weeklyGroupSales,
            'totalMember' => $totalMember,
            'totalAgent' => $totalAgent,
            'totalMaster' => $totalMaster,
            'totalShare' => $totalShare,
            'banner' => $banner,
            'masterAgentRacing' => $masterAgentRacing,
            'managerRacing' => $managerRacing
        ];

        return view('partner.dashboard', $params);
    }  
}