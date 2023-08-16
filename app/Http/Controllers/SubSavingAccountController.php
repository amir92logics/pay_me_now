<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\SubSavingAccount;
use Illuminate\Support\Facades\DB;
use App\Models\SubSavingAccountLog;

class SubSavingAccountController extends Controller
{
    public function __construct()
    {
        return $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $pageTitle = "Sub Saving Accounts";
        $emptyMessage = "You Don't Have Sub Saving Account";
        $accounts = SubSavingAccount::where('user_id', auth()->id())->get();
        return view($this->activeTemplate . 'user.subsavingaccounts.index', compact('pageTitle', 'emptyMessage', 'accounts'));
    }

    public function create()
    {
        $accounts = SubSavingAccount::where('user_id', auth()->id())->count();
        $accountsLimit = config('subsavingaccounts.accounts_limit');
        if ($accounts >= $accountsLimit) {
            $notify[] = ['error', "You have reached the max Sub Saving Accounts Limit of $accountsLimit"];
            return redirect(route('user.home'))->withNotify($notify);
            exit();
        }
        $pageTitle = 'New Sub Saving Account';
        return view($this->activeTemplate . 'user.subsavingaccounts.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $accounts = SubSavingAccount::where('user_id', auth()->id())->count();
        $accountsLimit = config('subsavingaccounts.accounts_limit');
        if ($accounts >= $accountsLimit) {
            $notify[] = ['error', "You have reached the max Sub Saving Accounts Limit of $accountsLimit"];
            return redirect(route('user.home'))->withNotify($notify);
            exit();
        }
        $balance = auth_user()->balance;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['nullable', 'numeric', 'max:' . number_format($balance, 2)],
        ]);
        DB::transaction(function () use ($request, $balance) {
            $account = SubSavingAccount::create([
                'name' => $request->input('name'),
                'amount' => $request->input('amount'),
            ]);
            if ($request->input('amount') > 0) {
                auth_user()->update([
                    'balance' => ($balance - $request->input('amount'))
                ]);
                $account->log()->create([
                    'trx' => getTrx(6, 'SSAC'),
                    'trx_type' => trx_type_int(),
                    'details' => 'Account Created',
                    'amount' => $request->input('amount'),
                    'initial_balance' => 0,
                ]);
            }
        });
        $notify[] = ['success', "Sub Account Created"];
        return back()->withNotify($notify);
    }


    public function show(SubSavingAccount $subSavingAccount)
    {
        abort_unless(auth()->id() == $subSavingAccount->user_id, 404, "Page Not Found");
        $pageTitle = "Sub Saving Account $subSavingAccount->name";
        $emptyMessage = "No Transaction Happen In this Account";
        $transactions = SubSavingAccountLog::where('sub_saving_account_id', $subSavingAccount->id)->paginate(10);
        return view($this->activeTemplate . 'user.subsavingaccounts.show', compact('pageTitle', 'emptyMessage', 'subSavingAccount', 'transactions'));
    }


    public function edit(SubSavingAccount $subSavingAccount)
    {
        $pageTitle = "Sub Saving Accounts";
        return view('user.user.subsavingaccounts.edit', compact('pageTitle', 'subSavingAccount'));
    }


    public function update(Request $request, SubSavingAccount $subSavingAccount)
    {
        $balance = auth_user()->balance;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            // 'amount' => ['nullable', 'numeric', 'max:' . number_format($balance, 2)],
        ], [
            'status.in' => 'Status Either Enable Or Disable',
        ]);
        DB::transaction(function () use ($request, $subSavingAccount, $balance) {
            $subSavingAccount->update([
                'name' => $request->input('name'),
                'status' => $request->input('status')
                // 'amount' => $request->input('amount'),
            ]);
            // if ($request->input('amount') > 0) {
            //     auth_user()->update([
            //         'balance' => ($balance - $request->input('amount'))
            //     ]);
            //     $account->log()->create([
            //         'trx' => getTrx(6, 'SSAC'),
            //         'trx_type' => trx_type_int(),
            //         'details' => 'Account Created',
            //         'amount' => $request->input('amount'),
            //         'initial_balance' => 0,
            //     ]);
            // }
        });
        $notify[] = ['success', "Sub Saving Account Updated"];
        return back()->withNotify($notify);
    }


    public function trx(Request $request)
    {
        abort_if(is_null($request->input('account')), 401);

        $subAccount = SubSavingAccount::where('user_id', auth()->id())->findOrFail($request->input('account'));
        if ($subAccount->status == 0) {
            $notify[] = ['error', "Your Account is Disabled, First Enable it"];
            return back()->withNotify($notify);
        }
        $request->validate([
            'amount' => 'required|numeric|gt:0',
        ]);

        if (($request->boolean('act') && $request->input('amount') > auth_user()->balance) || (!$request->boolean('act') && $request->input('amount') > $subAccount->amount)) {
            $notify[] = ['error', 'You has insufficient balance.'];
            return back()->withNotify($notify);
        }

        $notify[] = DB::transaction(function () use ($request, $subAccount) {
            $amount = $request->input('amount');
            $subAmount = $subAccount->amount;
            $balance = auth_user()->balance;
            $general = GeneralSetting::first(['cur_text', 'cur_sym']);
            if ($request->boolean('act')) {
                $trx = getTrx(6, 'SSAC');
                auth_user()->update([
                    'balance' => ($balance - $amount)
                ]);
                $subAccount->log()->create([
                    'trx' => $trx,
                    'trx_type' => trx_type_int(),
                    'details' => $request->input('details'),
                    'amount' => $amount,
                    'initial_balance' => $subAmount,
                ]);
                $subAccount->update([
                    'amount' => ($subAmount + $amount)
                ]);

                notify(auth_user(), 'BAL_ADD', [
                    'trx' => $trx,
                    'amount' => showAmount($amount),
                    'currency' => $general->cur_text,
                    'post_balance' => showAmount(auth_user()->balance),
                ]);
            } else {
                $trx = getTrx(6, 'SSAD');
                auth_user()->update([
                    'balance' => ($balance + $amount)
                ]);

                $subAccount->log()->create([
                    'trx' => $trx,
                    'trx_type' => trx_type_int('debit'),
                    'details' => $request->input('details'),
                    'amount' => $amount,
                    'initial_balance' => $subAccount->amount,
                ]);

                $subAccount->update([
                    'amount' => ($subAmount - $amount)
                ]);
                notify(auth_user(), 'BAL_SUB', [
                    'trx' => $trx,
                    'amount' => showAmount($amount),
                    'currency' => $general->cur_text,
                    'post_balance' => showAmount(auth_user()->balance)
                ]);
            }
            return ['success', $general->cur_sym . $amount . ' has been transfered'];
        });
        return back()->withNotify($notify);
    }
}
