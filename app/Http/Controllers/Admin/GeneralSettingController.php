<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Frontend;
use Illuminate\Http\Request;
use App\Models\DashboardSlide;
use App\Models\GeneralSetting;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general = GeneralSetting::first();
        $pageTitle = 'General Setting';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.general_setting', compact('pageTitle', 'general', 'timezones'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'base_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'secondary_color' => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'timezone' => 'required',
            'google_map_api_key' => ['required'],
        ]);

        $general = GeneralSetting::first();

        $general->ev = $request->ev ? 1 : 0;
        $general->en = $request->en ? 1 : 0;
        $general->sv = $request->sv ? 1 : 0;
        $general->sn = $request->sn ? 1 : 0;
        $general->force_ssl = $request->force_ssl ? 1 : 0;
        $general->registration = $request->registration ? 1 : 0;
        $general->agree = $request->agree ? 1 : 0;
        $general->sitename = $request->sitename;
        $general->cur_text = $request->cur_text;
        $general->news = $request->news;
        $general->base_color = $request->base_color;
        $general->secondary_color = $request->secondary_color;
        $general->google_map_api_key = $request->google_map_api_key;
        $general->meta = [
            'crypto' => $request->crypto ?? 0,
            'card' => $request->card ?? 0,
            'savings' => $request->savings ?? 0,
            'other_bank' => $request->other_bank ?? 0,
        ];
        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content = '<?php $timezone = ' . $request->timezone . ' ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'General setting has been updated.'];
        return back()->withNotify($notify);
    }


    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'favicon' => ['image', new FileTypeValidate(['png'])],
        ]);
        if ($request->hasFile('logo')) {
            try {
                $path = imagePath()['logoIcon']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Logo could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = imagePath()['logoIcon']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', imagePath()['favicon']['size']);
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Favicon could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon has been updated.'];
        return back()->withNotify($notify);
    }

    public function dashboardslide()
    {
        $pageTitle = 'Dashboard Slides';
        $slides = DashboardSlide::all();
        return view('admin.setting.slides_dashboard', compact('pageTitle', 'slides'));
    }

    public function slideDestroy(Request $request)
    {
        $slide = DashboardSlide::findOrFail($request->input('id'));
        try {
            $oldPath = imagePath()['dashboardSlide']['path'] . '/' . $slide->path;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $slide->delete();
        } catch (\Exception $th) {
            $notify[] = ['error', 'Dashboard Slide Image could not be deleted.'];
            return back()->withNotify($notify);
        }

        $notify[] = ['success', 'Dashboard Slide Image has been deleted.'];
        return back()->withNotify($notify);
    }

    public function slideUpdate(Request $request)
    {
        abort_if(is_null($request->input('updateId')), 404, "Resource Not Found");
        $request->validate([
            'image' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $slide = DashboardSlide::findOrFail($request->input('updateId'));
        if ($request->hasFile('image')) {
            try {
                $path = imagePath()['dashboardSlide']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $filename = date('Y_m_d_H_i_s');
                $oldPath = imagePath()['dashboardSlide']['path'] . '/' . $slide->path;
                $slide->update([
                    'path' => "$filename.png"
                ]);
                Image::make($request->image)->save($path . "/$filename.png");
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Dashboard Slide Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Dashboard Slide Image has been updated.'];
        return back()->withNotify($notify);
    }

    public function slidestore(Request $request)
    {
        $request->validate([
            'image' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        if ($request->hasFile('image')) {

            try {
                $path = imagePath()['dashboardSlide']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $filename = date('Y_m_d_H_i_s');
                DashboardSlide::create([
                    'path' => "$filename.png"
                ]);
                Image::make($request->image)->save($path . "/$filename.png");
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Dashboard Slide Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Dashboard Slide Image has been created.'];
        return back()->withNotify($notify);
    }

    public function dashboardSlideUpdate(Request $request)
    {

        $request->validate([
            'slide' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        if ($request->hasFile('slide')) {

            try {
                $path = imagePath()['dashboardSlide']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->slide)->save($path . '/slide.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Dashboard Slide Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Dashboard Slide Image has been updated.'];
        return back()->withNotify($notify);
    }

    public function cookie()
    {
        $pageTitle = 'GDPR Cookie';
        $cookie = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        return view('admin.setting.cookie', compact('pageTitle', 'cookie'));
    }

    public function cookieSubmit(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'description' => 'required',
        ]);
        $cookie = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        $cookie->data_values = [
            'link' => $request->link,
            'description' => $request->description,
            'status' => $request->status ? 1 : 0,
        ];
        $cookie->save();
        $notify[] = ['success', 'Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }
}
