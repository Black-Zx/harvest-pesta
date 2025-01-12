<?php

namespace App\Http\Controllers\CustomerService;

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerService\BaseController;
use App\Models\Banner;
use App\Models\Photo;
use App\Models\CustomerServiceNotifications;
use App\Models\Notification;
use Storage;

class PageController extends BaseController {

    public function dashboard()
    {
        return view('cs.dashboard');
    }

    public function showBannerForm() 
    {

        $photos = Photo::get();
        $banner = Banner::first();

        $params = [
            'photos' => $photos,
            'banner' => $banner
        ];

        return view('cs.banner', $params);
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $file = $request->file("image");
        $originalPath = '/banners/';
        $photoFileName = $originalPath.time().'_banner.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($photoFileName, file_get_contents($file));
        $request['image'] = $photoFileName;

        $result = $this->bannerRepo->upload($request->input());

        return redirect()->back()->withSuccess('Great! You have Uploaded');
    }

    public function selectBanner(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|integer',
        ]);

        $result = $this->bannerRepo->change($request->input());

        return redirect()->back()->withSuccess('Great!');
    }

    public function getNotification()
    {
        $available = CustomerServiceNotifications::where(['customer_service_id' => $this->user->id, 'is_used' => 0])->get();

        $notificationIds = [];

        foreach ($available as $value) {

            array_push($notificationIds, $value->notification_id);
            $value->is_used = 1;
            $value->save();
        }

        $notifications = Notification::whereIn('id', $notificationIds)->get();

        return response()->json(['status' => true, 'notification' => $notifications]);
    }

    public function showNotification()
    {
        $available = CustomerServiceNotifications::where(['customer_service_id' => $this->user->id])->orderByDesc('created_at')->paginate(20);

        $params = [
            'notifications' => $available
        ];

        return view('cs.notification', $params);
    }
}