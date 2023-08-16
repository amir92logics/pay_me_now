<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $option = Option::where('key', 'notify-settings')->first()->value;
        $pageTitle = 'Notifications Settings';
        return view('admin.notify-settings.index', compact('pageTitle', 'option'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fund_transfer_push' => 'nullable|integer',
            'fund_transfer_email' => 'nullable|integer',
            'withdraw_push' => 'nullable|integer',
            'withdraw_email' => 'nullable|integer',
            'deposit_push' => 'nullable|integer',
            'deposit_email' => 'nullable|integer',
        ]);

        $option = Option::where('key', 'notify-settings')->first();
        if ($option) {
            $option->update([
                'key' => 'notify-settings',
                'value' => $request->except('_token'),
            ]);
        } else {
            Option::create([
                'key' => 'notify-settings',
                'value' => $request->except('_token'),
            ]);
        }

        return response()->json([
            'message' => 'Notify settings updated successfully.'
        ]);
    }
}
