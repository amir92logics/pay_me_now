<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\PlanTimer;
use App\Models\FixDeposit;
use App\Models\SavingPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

class FixedDepositController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function requestdeposits()
    {
        $pageTitle = 'New Interest Bearing';
        $user = Auth::user();
        $plans = Plan::latest()->where('status', 1)->get();
        return view($this->activeTemplate . 'user.fix_deposits.request', compact(
            'pageTitle',
            'user',
            'plans'
        ));
    }
    public function requestsubmit(Request $request)
    {

            $request->validate([
                'famount' => 'required|int|min:100'
            ], [
                'famount.required' => 'Please Enter An Amount'
            ]);
            $user = Auth::user();
            if ($user->balance < $request->famount) {
                $notify[] = ['error', 'You dont have enough balance to start this interest bearing plan.'];
                return back()->withNotify($notify);
            }
        $plans = Plan::latest()->where('status', 1)->get();
        $planMinAmount = $plans->firstWhere('id',$request->plan)->min_amount;
        $planMaxAmount = $plans->firstWhere('id',$request->plan)->max_amount;
// dd($planMaxAmount, $planMinAmount, $request->amount);
           if ($request->famount < $planMinAmount) {
                $notify[] = ['error', 'Amount Smaller Than Minimum Amount'];
                return back()->withNotify($notify);
            }
            if ($request->famount > $planMaxAmount) {
                $notify[] = ['error', 'Amount Greater Than Maximum Amount'];
                return back()->withNotify($notify);
            }
        $user = Auth::user();

        $fDeposit = new FixDeposit();
        $fDeposit->plan_id = $request->plan; // Plan method ID
        $fDeposit->user_id = $user->id;
            $user->balance -= $request->amount;
            $user->save();

            $fDeposit->balance += $request->amount;

            $fDeposit->amount = $request->famount;
        $fDeposit->status = 0;
        $fDeposit->reference = getTrx();

        $fDeposit->save();

        $notify[] = ['success', 'Fixed Deposit Created Successfully.'];
        return back()->withNotify($notify);
    }
    public function mydeposits()
    {
        $pageTitle = 'My Interest Plan';
        $user = Auth::user();
        $saved = FixDeposit::where('user_id', $user->id)->paginate(10);
        $plans = Plan::latest()->where('status', 1)->get();

        // dd($plans);
        $emptyMessage = "Data Not Found";

        return view($this->activeTemplate . 'user.fix_deposits.mydeposits', compact('pageTitle', 'saved', 'emptyMessage', 'plans'));
    }

    public function depositbalance()
    {
        $pageTitle = 'deposit Balance';
        $user = Auth::user();

        return view($this->activeTemplate . 'user.fix_deposits.history', compact('pageTitle'));
    }

    // public function viewsaved($id)
    // {
    //     $user = Auth::user();
    //     $saved = FixDeposit::where('user_id', $user->id)->first();
    //     // dd('gfh', $saved, $id);
    //     if (!$saved) {
    //         $notify[] = ['error', 'Invalid deposits Request.'];
    //         return back()->withNotify($notify);
    //     }


    //     $pageTitle = 'My deposits Log';


    //     $year = date('Y');
    //     $month = date('m');
    //     $day = date('d');
    //     $jan = '01';
    //     $feb = '02';
    //     $mar = '03';
    //     $apr = '04';
    //     $may = '05';
    //     $jun = '06';
    //     $jul = '07';
    //     $aug = '08';
    //     $sep = '09';
    //     $oct = '10';
    //     $nov = '11';
    //     $dec = '12';

    //     $data['jan'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $jan)->sum('amount');
    //     $data['feb'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $feb)->sum('amount');
    //     $data['mar'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $mar)->sum('amount');
    //     $data['apr'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $apr)->sum('amount');
    //     $data['may'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $may)->sum('amount');
    //     $data['jun'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $jun)->sum('amount');
    //     $data['jul'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $jul)->sum('amount');
    //     $data['aug'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $aug)->sum('amount');
    //     $data['sep'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $sep)->sum('amount');
    //     $data['oct'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $oct)->sum('amount');
    //     $data['nov'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $nov)->sum('amount');
    //     $data['dec'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $dec)->sum('amount');


    //     $pay = SavingPay::where('user_id', $user->id)->whereLoanId($id)->get();
    //     $sum = SavingPay::where('user_id', $user->id)->whereLoanId($id)->sum('amount');
    //     $data['count'] = SavingPay::where('user_id', $user->id)->whereLoanId($id)->count();
    //     return view($this->activeTemplate . 'user.fix_deposits.view', $data, compact('pageTitle', 'saved', 'pay', 'sum'));
    // }

}
