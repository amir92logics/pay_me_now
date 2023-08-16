<?php

namespace App\Http\Controllers\Admin;

use App\Models\Atm;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;

class AtmController extends Controller
{

    public function index()
    {
        $pageTitle = "Atms List";
        $emptyMessage = "No ATM Found";
        $atms = Atm::paginate(20);
        $general = GeneralSetting::first();
        return view('admin.atms.index', compact('pageTitle', 'emptyMessage', 'atms', 'general'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        Atm::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);
        $notify[] = ['success', 'ATM Location created successfully.'];
        return back()->withNotify($notify);
    }


    public function show(Atm $atm)
    {
        $pageTitle = "Atm";
        $general = GeneralSetting::first();
        return view('admin.atms.show', compact('pageTitle', 'atm', 'general'));
    }

    public function edit(Atm $atm)
    {
        $pageTitle = "Update Atm $atm->name";
        $general = GeneralSetting::first();
        return view('admin.atms.edit', compact('pageTitle', 'atm', 'general'));
    }

    public function update(Request $request, Atm $atm)
    {
        $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        $atm->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'status' => $request->boolean('status'),
        ]);
        $notify[] = ['success', 'ATM Location updated successfully.'];
        return back()->withNotify($notify);
    }

    public function destroy(Atm $atm)
    {
        $atm->delete();
        $notify[] = ['success', 'ATM Location deleted successfully.'];
        return back()->withNotify($notify);
    }
}
