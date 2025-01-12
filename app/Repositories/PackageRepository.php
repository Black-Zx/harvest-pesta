<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Models\PackageUser;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PackageRepository implements PackageRepositoryInterface
{
    public function asign(array $array){
        $user = User::find($array['user_id'])->package()->sync($array['package_id']);
        // if ($check) {
        //     $result = $check;
        // }else{
        //     $result = new PackageUser;
        // }
        // $result->user_id = $array['user_id'];
        // $result->package_id = $array['package_id'];
        // $result->save();
        // $user->touch();
        return $user;
    }
}