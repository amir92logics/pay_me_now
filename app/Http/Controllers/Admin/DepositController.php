<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Deposit;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    use HasUploader;

    public function index()
    {
        $pageTitle = 'Deposits list';
        $deposits = Deposit::when(request('search'), function($q) {
                            $q->where('trx', 'like', '%'.request('search').'%')
                            ->orWhere('amount', 'like', '%'.request('search').'%')
                            ->orWhere('type', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate();

        return view('admin.deposits.index', compact('deposits', 'pageTitle'));
    }

    public function show(Deposit $deposit)
    {
        return view('admin.deposits.show', compact('deposit'));
    }

    public function approved($id)
    {
        // dd('test');
        $deposit = Deposit::findOrFail($id);
        $user = User::findOrFail($deposit->user_id);
        $user->update([
            'balance' => $user->balance + ($deposit->amount - $deposit->charge)
        ]);
        $deposit->update([
            'status' => 1
        ]);

        return redirect(route('admin.deposits.index'))->with('success', __('Withdraw approved successfully.'));
    }

    public function reject($id)
    {
        $deposit = Deposit::findOrFail($id);
        if ($deposit->status == 1) {
            $user = User::findOrFail($deposit->user_id);
            $user->update([
                'balance' => $user->balance - $deposit->amount
            ]);
        }
        $deposit->update([
            'status' => 0
        ]);

        return redirect(route('admin.deposits.index'))->with('success', __('Withdraw rejected successfully.'));
    }
}
