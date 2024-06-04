<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;
use Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;
    function index(): View
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $avatarPath = $this->uploadImage($request, 'avatar', $request->old_avatar);
        $bannerPath = $this->uploadImage($request, 'banner', $request->old_banner);

        $user  = Auth::user();
        $user->avatar = !empty($avatarPath) ? $avatarPath : $request->old_avatar;
        $user->banner = !empty($bannerPath) ? $bannerPath : $request->old_banner;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->website = $request->website;
        $user->fb_link = $request->fb_link;
        $user->x_link = $request->x_link;
        $user->in_link = $request->in_link;
        $user->wa_link = $request->wa_link;
        $user->insta_link = $request->insta_link;
        $user->update();

        toastr()->success('Updated Successfully');

        return redirect()->back();
    }

    function passwordUpdate(Request $request) :RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            "password" => 'required|confirmed'
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->created_at = now();
        $user->update();
        toastr()->success('Updated Successfully');

        return redirect()->back();
    }
}
