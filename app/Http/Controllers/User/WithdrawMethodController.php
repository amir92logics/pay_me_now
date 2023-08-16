<?php

namespace App\Http\Controllers\User;

use App\Mail\OtpMail;
use App\Mail\PayoutMail;
use App\Models\Usermethod;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class WithdrawMethodController extends Controller
{
    public function index()
    {
        $methods = WithdrawMethod::whereStatus(1)->with('usermethod')->latest()->get();
        $pending_amount = Withdrawal::whereStatus(2)->whereUserId(auth()->id())->sum('amount');
        return view('user.user.withdraw.methods', compact('methods', 'pending_amount'));
    }

    public function show($id)
    {
        $method = WithdrawMethod::findOrFail($id);
        $usermethod = Usermethod::where('withdraw_method_id', $id)->first();
        return view('user.user.withdraw.methods-show', compact('method', 'usermethod'));
    }

    public function makewithdraw($method_id) {
        $usermethod = Usermethod::where('withdraw_method_id', $method_id)->first();
        if (!$usermethod) {
            abort(404);
        }
        $method = WithdrawMethod::whereStatus(1)->findOrFail($method_id);
        return view('user.user.withdraw.make-withdraw', compact('method', 'usermethod'));
    }

    public function update(Request $request, $method_id) {
        $method = WithdrawMethod::findOrFail($method_id);
        $usermethod = Usermethod::where('withdraw_method_id', $method_id)->first();
        if ($usermethod) {
            $usermethod->update([
                'withdraw_infos' => $request->except('_token', '_method'),
            ]);
        } else {
            Usermethod::create([
                'user_id' => auth()->id(),
                'withdraw_infos' => $request->except('_token', '_method'),
                'withdraw_method_id' => $method->id,
            ]);
        }

        return response()->json([
            'message' => __('Withdraw updated successfully.'),
            'redirect' => route('user.withdraw-methods.index')
        ]);
    }

    public function getotp(Request $request, $method_id) {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        $method = WithdrawMethod::findOrFail($method_id);
        if ($method) {
            if (auth()->user()->balance >= $request->amount) {
                if ($method->min_limit <= $request->amount) {
                    if ($method->max_limit >= $request->amount) {

                        $otp = rand();
                        session()->put('payout_otp', $otp);
                        session()->put('payout_amount', $request->amount);

                        if (env('QUEUE_MAIL')) {
                            Mail::to('safiullalam9931@gmail.com')->queue(new OtpMail($otp, $request->amount));
                        } else {
                            Mail::to('safiullalam9931@gmail.com')->send(new OtpMail($otp, $request->amount));
                        }

                        return response()->json([
                            'redirect' => route('user.payout.otp', $method_id),
                            'message' => "An OTP has been sended to your mail. Please check and confirm."
                        ], 200);
                    } else {
                        return response()->json('Maximum transaction amount '.$method->max_limit, 404);
                    }
                } else {
                    return response()->json('Minimum transaction amount '.$method->min_limit, 404);
                }
            } else {
                return response()->json('Insufficient balance. Your balance is '. (auth()->user()->balance ?? 0), 404);
            }
        } else {
            return response()->json('Method not found.', 404);
        }
    }

    public function otp($method_id) {
        $payout_otp = session()->get('payout_otp');
        $payout_amount = session()->get('payout_amount');
        if (!$payout_otp && !$payout_amount) {
            return back();
        }
        $method = WithdrawMethod::findOrFail($method_id);

        $charge = $method->fixed_charge;
        if ($method->charge_type == 'percentage') {
            $charge = $method->percent_charge;
        }

        session()->put('method_charge', $charge);

        return view('user.user.withdraw.success');
    }

    public function success(Request $request, $method_id) {
        $payout_otp = session()->get('payout_otp');
        $payout_amount = session()->get('payout_amount');
        if (!$payout_otp && !$payout_amount) {
            abort(404);
        }
        $method = WithdrawMethod::findOrFail($method_id);

        if ($payout_otp == $request->otp) {

            $total_charge = session('method_charge');

            DB::beginTransaction();
            try {
                $payout = Withdrawal::create([
                    'charge' => $total_charge,
                    'user_id' => auth()->id(),
                    'amount' => $payout_amount,
                    'method_id' => $method_id,
                ]);

                $notify = new AdminNotification();
                $notify->user_id = auth()->id();
                $notify->title = 'New withdraw request from '. auth()->user()->firstname;
                $notify->click_url = urlPath('admin.withdraw.show', $payout->id);
                $notify->save();

                auth()->user()->update([
                    'balance' => auth()->user()->balance - $payout_amount
                ]);

                // Send Email to admin
                if (env('QUEUE_MAIL')) {
                    Mail::to(env('MAIL_TO'))->queue(new PayoutMail($payout, $method->name));
                } else {
                    Mail::to(env('MAIL_TO'))->send(new PayoutMail($payout, $method->name));
                }

                session()->forget('payout_otp');
                session()->forget('payout_amount');
                session()->forget('method_charge');

                DB::commit();

                return response()->json([
                    'redirect' => route('user.withdraw-methods.index'),
                    'message' => __('Withdraw request successfully.'),
                ]);

            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    'message' =>  __('Something was wrong, Please contact with author.'),
                ]);
            }
        } else {
            return response()->json(__('Your OTP is incorrect please check your mail and confirm.'), 404);
        }
    }
}
