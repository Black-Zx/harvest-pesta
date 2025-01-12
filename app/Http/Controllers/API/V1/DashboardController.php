<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BonusPool;
use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepositoryInterface;
Use Image;

class DashboardController extends BaseController
{
    public function __construct(BannerRepositoryInterface $bannerRepo)
    {
        $this->bannerRepo = $bannerRepo;
    }
   
    public function getGroupBonus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'week_num' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user_id = Auth::user()->id;
        $users = User::defaultOrder()->descendantsAndSelf($user_id);
        foreach ($users as $key => $user) {
            $user->bonus_earned = $user->bonuses()->EarnedBonus($request->week_num);
        }

        return $this->sendResponse($users, 'Success.');
    }

    public function totalMemberByType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rank_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(User::RankCount($request->rank_id), 'Success.');
    }

    public function winningPool(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required',Rule::in([BonusPool::masterAgent, BonusPool::shareholder])]
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(BonusPool::where('type',$request->type)->get(), 'Success.');
    }

    public function bonusPoint()
    {
        return $this->sendResponse(Auth::user()->totalBonus(), 'Success.');
    }

    public function insurancePoint()
    {
        return $this->sendResponse(Auth::user()->totalInsurancePoint(), 'Success.');
    }

    public function directSponsorBonus()
    {
        return $this->sendResponse(Auth::user()->bonuses()->BonusCommission(), 'Success.');
    }

    public function otherBonus()
    {
        return $this->sendResponse(Auth::user()->bonuses()->BonusOther(), 'Success.');
    }

    public function uploadBanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'state' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $file = $request->file("image");
        $ogImage = Image::make($file);
        $originalPath = public_path().'/banners/';
        $photoFileName = $originalPath.time().$file->getClientOriginalName();
        $ogImage =  $ogImage->save($photoFileName);
        $tmp_file_name[] = $photoFileName;
        $request['image'] = $tmp_file_name;

        return $this->sendResponse($this->bannerRepo->change($request->input()), 'Success.');
    }

    public function showBanner()
    {
        return $this->sendResponse(Banner::get(), 'Success.');
    }

}
