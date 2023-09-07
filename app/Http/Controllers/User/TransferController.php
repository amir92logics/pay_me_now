<?php

namespace App\Http\Controllers\User;

use Throwable;
use App\Models\User;
use App\Models\Transfer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\MoneyTransferMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiarys = Transfer::whereSenderId(auth()->id())->where('is_beneficiary', 1)->get();
        $transfers = Transfer::whereSenderId(auth()->id())->latest()
                    ->when(request('search'), function($q) {
                        $q->where('trx', 'like', '%' . request('search') . '%');
                        $q->orWhere('amount', 'like', '%' . request('search') . '%');
                        $q->orWhere('email', 'like', '%' . request('search') . '%');
                    })
                    ->orWhere('email', auth()->user()->email)
                    ->with('sender')->paginate(10);
                    $total= Transfer::whereSenderId(auth()->id())->sum('amount');
        $completed = Transfer::whereSenderId(auth()->id())->whereStatus(2)->sum('amount');
        $pending = Transfer::whereSenderId(auth()->id())->whereStatus(1)->sum('amount');
        $refund = Transfer::whereSenderId(auth()->id())->whereStatus(3)->sum('amount');
        $cancled = Transfer::whereSenderId(auth()->id())->whereStatus(0)->sum('amount');
        return view('user.user.transfers.index', compact('transfers', 'beneficiarys', 'total', 'completed', 'pending', 'refund', 'cancled'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'email' => 'required|email',
            'amount' => 'required|integer|min:1',
            'is_beneficiary' => 'nullable|boolean',
        ]);

        if (Hash::check($request->password, auth()->user()->password)) {
            if (auth()->user()->balance > $request->amount) {
                // \DB::beginTransaction();
                // try {

                    Transfer::create([
                        'sender_id' => auth()->id(),
                        'email' => $request->email,
                        'amount' => $request->amount,
                        'is_beneficiary' => $request->is_beneficiary,
                        'charge' => 0,
                        'trx' => 'tr_'.time().rand(1,100),
                    ]);

                    Transaction::create([
                        'user_id' => auth()->id(),
                        'amount' => $request->amount,
                        'charge' => 0,
                        'post_balance' => auth()->user()->balance - $request->amount,
                        'trx_type' => '-',
                        'trx' => time().rand(1,1000),
                        'details' => 'Transfer money',
                    ]);

                    $old_user = User::where('email', $request->email)->exists();

                    $user = User::find(auth()->id());
                    $user->balance = $user->balance - $request->amount;
                    $user->save();

                    $options = [
                        'name' => $user->firstname .' '.$user->lastname,
                        'email' => $request->email,
                        'amount' => $request->amount,
                        'url' => $old_user ? route('user.transfers.index'):route('user.register', $request->email),
                    ];

                    if (config('system.queue.mail')) {
                        Mail::to($request->email)->queue(new MoneyTransferMail($options));
                    } else {
                        Mail::to($request->email)->send(new MoneyTransferMail($options));
                    }

                    // \DB::commit();

                    return response()->json([
                        'message' => $request->is_beneficiary ? __("Transfer successful. Beneficiary created successfully") : __("Transfer successful."),
                        'redirect' => route('user.transfers.index'),
                    ]);

                // } catch (Throwable $th) {
                //     \DB::rollback();
                //     return response()->json([
                //         'message' => __('Something was wrong, Please contact with author.')
                //     ], 404);
                // }
            } else {
                return response()->json([
                    'message' => __("Insufficient balance.")
                ], 404);
            }
        } else {
            return response()->json([
                'message' => __("Your password is wrong.")
            ], 404);
        }
    }

    public function show(Request $request, Transfer $transfer)
    {
        \DB::beginTransaction();
        try {
            if ($request->type == 'accept') {
                $transfer->update([
                    'status' => 2
                ]);
                $user = User::findOrFail(auth()->id());
                $user->balance = $user->balance + $transfer->amount;
                $user->save();

                Transaction::create([
                    'user_id' => auth()->id(),
                    'amount' => $transfer->amount,
                    'charge' => 0,
                    'post_balance' => $user->balance,
                    'trx_type' => '+',
                    'trx' => time().rand(1,1000),
                    'details' => 'Transfer money received',
                ]);

                \DB::commit();

                return response()->json([
                    'message' => __('Transfer money accepted successfully.'),
                    'redirect' => route('user.transfers.index'),
                ]);
            } elseif ($request->type == 'cancle') {

                $transfer->update([
                    'status' => 0
                ]);
                $user = User::findOrFail($transfer->sender_id);
                $user->update([
                    'balance' => $user->balance + ($transfer->amount + $transfer->charge)
                ]);

                Transaction::create([
                    'user_id' => $transfer->sender_id,
                    'amount' => $transfer->amount + $transfer->charge,
                    'charge' => 0,
                    'post_balance' => $user->balance + $request->amount + $transfer->charge,
                    'trx_type' => '+',
                    'trx' => time().rand(1,1000),
                    'details' => 'Transfer money back',
                ]);

                \DB::commit();

                return response()->json([
                    'message' => __('Transfer money has been canceled.'),
                    'redirect' => route('user.transfers.index'),
                ]);
            }

        } catch (Throwable $th) {
            \DB::rollback();
            return response()->json([
                'message' => __('Something was wrong, Please contact with author.'),
                'redirect' => route('user.transfers.index'),
            ], 404);
        }
    }


    public function destroy(Transfer $transfer)
    {
        abort_if($transfer->user_id != auth()->id(), 404);
        $transfer->is_beneficiary = 0;
        $transfer->save();
        return response()->json([
            'message' => __('Beneficiary deleted successfully.'),
            'redirect' => route('user.transfers.index'),
        ]);
    }

    public function getTransfers()
    {
        $data['total'] = Transfer::whereUserId(auth()->id())->count();
        $data['completed'] = Transfer::whereUserId(auth()->id())->whereStatus(2)->count();
        $data['pending'] = Transfer::whereUserId(auth()->id())->whereStatus(1)->count();
        $data['refund'] = Transfer::whereUserId(auth()->id())->whereStatus(3)->count();
        $data['cancled'] = Transfer::whereUserId(auth()->id())->whereStatus(0)->count();
        return response()->json($data);
    }
}
