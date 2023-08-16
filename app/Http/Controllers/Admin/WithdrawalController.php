<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Usermethod;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    public function index()
    {
        $data['total_payouts'] = Withdrawal::count();
        $data['total_approved'] = Withdrawal::where('status', 'approved')->count();
        $data['total_rejected'] = Withdrawal::where('status', 'rejected')->count();
        $data['total_pending'] = Withdrawal::where('status', 'pending')->count();
        $data['withdraws'] = Withdrawal::latest()->with('method', 'user')
                    ->when(request('status') == 'approved', function($q) {
                        $q->where('status', 'approved');
                    })
                    ->when(request('status') == 'rejected', function($q) {
                        $q->where('status', 'rejected');
                    })
                    ->when(request('status') == 'pending', function($q) {
                        $q->where('status', 'pending');
                    })
                    ->paginate(10);

        return view('admin.withdraw.withdrawals', $data);
    }

    public function show($id)
    {
        $withdrawal = Withdrawal::with('user', 'method')->findOrFail($id);
        $usermethod = Usermethod::where('user_id', $withdrawal->user_id)->where('withdraw_method_id', $withdrawal->method_id)->first();
        $pageTitle = 'Withdrawal details';
        return view('admin.withdraw.detail', compact('pageTitle', 'withdrawal', 'usermethod'));
    }

    public function approved(Request $request)
    {
        $payout = Withdrawal::find($request->payout);
        if ($payout->status == 'rejected') {
            $user = User::find($payout->user_id);
            $user->update([
                'balance' => $user->balance - $payout->amount
            ]);
        }

        $payout->update([
            'status' => 'approved'
        ]);

        // Send Email to admin
        // if (env('QUEUE_MAIL')) {
        //     Mail::to(env('MAIL_TO'))->queue(new PayoutMail($payout));
        // } else {
        //     Mail::to(env('MAIL_TO'))->send(new PayoutMail($payout));
        // }

        return redirect(route('admin.withdraw.index'))->with('success', __('Withdrawal approved successfully.'));
    }

    public function reject(Request $request)
    {
        $payout = Withdrawal::find($request->payout);
        $user = User::find($payout->user_id);
        $user->update([
            'balance' => $user->balance + $payout->amount
        ]);
        $payout->update([
            'status' => 'rejected'
        ]);

        return redirect(route('admin.withdraw.index'))->with('success', __('Payout rejected successfully.'));
    }

}
