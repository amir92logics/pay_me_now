<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DashboardContent;
use App\Http\Controllers\Controller;

class DashboardContentController extends Controller
{
    public function dashboardfooter()
    {
        $pageTitle = 'Dashboard Footer';
        $footerContent = DashboardContent::where([
            'data_key' => 'dashboard.footer',
            ['data_type', 'LIKE', "%content%"]
        ])->get();
        $footerElements = DashboardContent::where([
            'data_key' => 'dashboard.footer',
            ['data_type', 'LIKE', "%element%"]
        ])->get();
        return view('admin.setting.dashboard_footer', compact('pageTitle', 'footerContent', 'footerElements'));
    }

    public function dashboardFooterStore(Request $request)
    {
        $request->validate([
            'text' => ['required'],
            'url' => ['required'],
        ]);
        DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'element.textlink',
            'data_text' => $request->input('text'),
            'data_text2' => $request->input('url'),
        ]);
        $notify[] = ['success', 'Dashboard Footer Link has been created.'];
        return back()->withNotify($notify);
    }

    public function dashboardFooterUpdate(Request $request)
    {
        $request->validate([
            'text' => ['required'],
            'url' => ['required'],
        ]);
        $dashboardContent = DashboardContent::findOrFail($request->input('updateId'));
        $dashboardContent->update([
            'data_text' => $request->input('text'),
            'data_text2' => $request->input('url'),
        ]);
        $notify[] = ['success', 'Dashboard Footer Link has been updated.'];
        return back()->withNotify($notify);
    }
    public function dashboardFooterEdit(Request $request)
    {
        $footer1 = DashboardContent::findOrFail(1);
        $footer2 = DashboardContent::findOrFail(2);
        $footer1->update([
            'data_text' => $request->input('footerContent1'),
        ]);
        $footer2->update([
            'data_text' => $request->input('footerContent2'),
        ]);
        $notify[] = ['success', 'Dashboard Footer has been updated.'];
        return back()->withNotify($notify);
    }

    public function footerDestroy(Request $request)
    {
        $dashboardContent = DashboardContent::findOrFail($request->input('id'));
        try {
            $dashboardContent->delete();
        } catch (\Exception $th) {
            $notify[] = ['error', 'Dashboard Fotter Content could not be deleted.'];
            return back()->withNotify($notify);
        }

        $notify[] = ['success', 'Dashboard Fotter Content has been deleted.'];
        return back()->withNotify($notify);
    }
}
