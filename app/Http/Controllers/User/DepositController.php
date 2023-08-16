<?php

namespace App\Http\Controllers\User;

use App\Models\Option;
use App\Models\Deposit;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;

class DepositController extends Controller
{
    use HasUploader;

    public function index()
    {
        $pageTitle = 'Deposits list';
        $deposits = Deposit::where('user_id', auth()->id())
                        ->when(request('search'), function($q) {
                            $q->where('trx', 'like', '%'.request('search').'%')
                            ->orWhere('amount', 'like', '%'.request('search').'%')
                            ->orWhere('type', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate();
        return view('user.deposits.index', compact('deposits', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Make new deposit';
        $banks = Bank::latest()->get();
        $cash_deposite = Option::where('key', 'cash_deposit')->latest()->first()->value;
        return view('user.deposits.create', compact('pageTitle', 'cash_deposite', 'banks'));
    }

    public function store(Request $request)
    {
        if ($request->type === 'cheque') {
            $request->validate([
                'amount' => 'required|integer',
                'front_cheque' => 'required|max:1024',
                'back_cheque' => 'required|max:1024',
            ]);

            $front_cheque = time().rand(1,1000).'.'.$request->front_cheque->extension();
            $request->front_cheque->move(public_path('images'), $front_cheque);

            $back_cheque = time().rand(1,1000).'.'.$request->back_cheque->extension();
            $request->back_cheque->move(public_path('images'), $back_cheque);

            Deposit::create([
                'user_id' => auth()->id(),
                'trx' => 'tr_' . time() . rand(1, 1000),
                'amount' => $request->amount,
                'type' => $request->type,
                'meta' => [
                    'front_cheque' => $front_cheque,
                    'back_cheque' => $back_cheque,
                ],
            ]);

            return response()->json([
                'message' => 'Your request has been saved, Please wait for approval.',
                'redirect' => route('user.deposits.index'),
            ]);
        } elseif ($request->type === 'bank_transfer') {
            $request->validate([
                'account_no' => 'required|string',
                'amount' => 'required|integer',
                'proof' => 'required|file',
                'bank_id' => 'required|exists:banks,id',
                'notes' => 'nullable|string',
            ]);

            $file_name = time().rand(1,1000).'.'.$request->proof->extension();
            $request->proof->move(public_path('images'), $file_name);

            Deposit::create([
                'user_id' => auth()->id(),
                'trx' => 'tr_' . time() . rand(1, 1000),
                'amount' => $request->amount,
                'type' => $request->type,
                'charge' => $request->type,
                'meta' => [
                    'notes' => $request->notes,
                    'account_no' => $request->account_no,
                    'bank_name' => $request->bank_name,
                    'proof' => $file_name,
                    'bank_id' => $request->bank_id,
                ],
            ]);

            return response()->json([
                'message' => 'Your request has been saved, Please wait for approval.',
                'redirect' => route('user.deposits.index'),
            ]);
        } elseif ($request->type === 'cash_deposit') {
            $request->validate([
                'amount' => 'required|integer',
                'notes' => 'nullable|string',
            ]);

            Deposit::create([
                'user_id' => auth()->id(),
                'trx' => 'tr_' . time() . rand(1, 1000),
                'amount' => $request->amount,
                'type' => $request->type,
                'meta' => [
                    'notes' => $request->notes,
                ],
            ]);

            return response()->json([
                'message' => 'Your request has been saved, Please wait for approval.',
                'redirect' => route('user.deposits.index'),
            ]);
        }
    }

    public function show(Deposit $deposit)
    {
        return view('user.deposits.show', compact('deposit'));
    }
}
