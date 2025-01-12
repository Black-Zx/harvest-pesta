<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BannerRepositoryInterface;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;
use App\Models\Photo;

class BannerRepository implements BannerRepositoryInterface
{
    public function change(array $array){
        $result = Banner::find(1);
        $result->created_by = Auth::user()->id;
        $result->update($array);
        return $result;
    }

    public function upload(array $array){
        $result = new Photo;
        $result->image = $array['image'];
        $result->created_by = Auth::user()->id;
        $result->save();
        return $result;
    }
}