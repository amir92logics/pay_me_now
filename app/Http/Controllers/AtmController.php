<?php

namespace App\Http\Controllers;

use App\Models\Atm;
use App\Models\GeneralSetting;

class AtmController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $pageTitle = "View ATM Locations";
        $emptyMessage = "No Atm Available";
        $atms = Atm::where('status', 1)->latest()->paginate(10);
        return view($this->activeTemplate . 'user.atms.index', compact('pageTitle', 'emptyMessage', 'atms'));
    }


    public function show(Atm $atm)
    {
        $pageTitle = "Atm";
        $general = GeneralSetting::first();
        return view($this->activeTemplate . 'user.atms.show', compact('pageTitle', 'atm', 'general'));
    }
}
