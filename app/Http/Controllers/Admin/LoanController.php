<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\Plan;
use App\Models\User;
use App\Models\LoanPay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoanPlan;
use App\Models\LoanAttribute;

class LoanController extends Controller
{
    public function index()
    {
        $pageTitle = 'Loan Plans';
        $plan = LoanPlan::latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view('admin.loan.index', compact('pageTitle', 'plan', 'emptyMessage'));
    }

    public function planCreate()
    {
        $pageTitle = 'Create new plan';
        return view('admin.loan.plan-create', compact('pageTitle'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'min' => 'required|numeric|gt:0',
            'max' => 'required|numeric|gt:min',
            'duration' => 'required|integer|gt:0',
            'penalty' => 'required|in:0,1',
            'interest' => 'required|numeric|gt:0',
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $field_name = strtolower(strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->field_name[$a])));
                $arr = [];
                $arr['field_name'] = str_replace(' ', '_', $field_name);
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }

        $plan = new LoanPlan();
        $plan->name = $request->name;
        $plan->min = $request->min;
        $plan->max = $request->max;
        $plan->penalty = $request->penalty;
        $plan->duration = $request->duration;
        $plan->fee = $request->interest;
        $plan->meta = $input_form;
        $plan->save();

        return response()->json([
            'message' => 'Loan Plan created successfully',
            'redirect' => route('admin.loan.index')
        ]);
    }

    public function edit($id)
    {
        $plan = LoanPlan::findOrFail($id);
        $pageTitle = 'Edit loan plan';
        return view('admin.loan.edit', compact('plan', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'min' => 'required|numeric|gt:0',
            'max' => 'required|numeric|gt:min',
            'duration' => 'required|integer|gt:0',
            'penalty' => 'required|in:0,1',
            'interest' => 'required|numeric|gt:0',
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $field_name = strtolower(strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->field_name[$a])));
                $arr = [];
                $arr['field_name'] = str_replace(' ', '_', $field_name);
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }

        $findPlan = LoanPlan::find($id);
        $findPlan->name = $request->name;
        $findPlan->min = $request->min;
        $findPlan->max = $request->max;
        $findPlan->penalty = $request->penalty;
        $findPlan->fee = $request->interest;  //	1=>Percent, 0=>Fixed
        $findPlan->duration = $request->duration;
        $findPlan->status = $request->status;
        $findPlan->meta = $input_form;
        $findPlan->save();

        $notify[] = ['success', 'Loan Plan updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function request()
    {
        // $loan = Loan::find(17);
        // dd($loan->load('attributes'));
        $pageTitle = 'Loan Requests';
        $loan = Loan::whereStatus(0)->paginate(10);
        $emptyMessage = "Data Not Found";

        return view('admin.loan.loan',  compact('pageTitle', 'loan', 'emptyMessage'));
    }

    public function approveloan($id)
    {

        $loan = Loan::whereStatus(0)->whereReference($id)->first();
        if (!$loan) {
            $notify[] = ['error', 'Invalid Loan Request'];
            return redirect()->back()->withNotify($notify);
        }
        $user = User::whereId($loan->user_id)->first();

        if ($user) {
            $user->balance += $loan->amount;
            $user->save();
        }
        $loan->status = 1;
        $loan->save();
        $notify[] = ['success', 'Loan Request Approved Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function rejectloan($id)
    {

        $loan = Loan::whereStatus(0)->whereReference($id)->first();
        if (!$loan) {
            $notify[] = ['error', 'Invalid Loan Request'];
            return redirect()->back()->withNotify($notify);
        }
        $loan->status = 3;
        $loan->save();
        $notify[] = ['success', 'Loan Request Rejected Successfully'];
        return redirect()->back()->withNotify($notify);
    }


    public function active()
    {
        $pageTitle = 'Active Loan';
        $loan = Loan::whereStatus(1)->paginate(10);
        $emptyMessage = "Data Not Found";

        return view('admin.loan.loan',  compact('pageTitle', 'loan', 'emptyMessage'));
    }

    public function closed()
    {
        $pageTitle = 'Closed Loan';
        $loan = Loan::whereStatus(2)->paginate(10);
        $emptyMessage = "Data Not Found";

        return view('admin.loan.loan',  compact('pageTitle', 'loan', 'emptyMessage'));
    }


    public function declined()
    {
        $pageTitle = 'Declined Loan';
        $loan = Loan::whereStatus(3)->paginate(10);
        $emptyMessage = "Data Not Found";

        return view('admin.loan.loan',  compact('pageTitle', 'loan', 'emptyMessage'));
    }

    public function preview(Loan $loan)
    {
        $pageTitle = "Attachment Preview";
        return view('admin.loan.preview', compact('pageTitle', 'loan'));
    }

    public function view($id)
    {
        
        $loan = Loan::whereReference($id)->with('user', 'plan')->first();
        // dd($loan->load('attributes'));
        if (!$loan) {
            $notify[] = ['error', 'Invalid Loan Request.'];
            return back()->withNotify($notify);
        }
        
        $pageTitle = 'View Loan';
        $plan = LoanPlan::where('id', $loan->plan_id)->where('status', 1)->first();
        $loanAttiribute = LoanAttribute::where('loan_id', $loan->id)->first();
        // dd($loanAttiribute);
        if (!$plan) {
            $notify[] = ['error', 'Invalid Loan Plan.'];
            return back()->withNotify($notify);
        }

        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $jan = '01';
        $feb = '02';
        $mar = '03';
        $apr = '04';
        $may = '05';
        $jun = '06';
        $jul = '07';
        $aug = '08';
        $sep = '09';
        $oct = '10';
        $nov = '11';
        $dec = '12';

        $data['jan'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $jan)->sum('amount');
        $data['feb'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $feb)->sum('amount');
        $data['mar'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $mar)->sum('amount');
        $data['apr'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $apr)->sum('amount');
        $data['may'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $may)->sum('amount');
        $data['jun'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $jun)->sum('amount');
        $data['jul'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $jul)->sum('amount');
        $data['aug'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $aug)->sum('amount');
        $data['sep'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $sep)->sum('amount');
        $data['oct'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $oct)->sum('amount');
        $data['nov'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $nov)->sum('amount');
        $data['dec'] = LoanPay::whereYear('created_at', $year)->whereLoanId($id)->whereMonth('created_at', $dec)->sum('amount');


        $pay = LoanPay::whereLoanId($id)->get();
        $sum = LoanPay::whereLoanId($id)->sum('amount');
        return view('admin.loan.view', $data, compact('pageTitle', 'loan', 'pay', 'sum', 'loanAttiribute'));
    }



    public function close(Request $request, $id)
    {

        $loan = Loan::whereStatus(1)->whereReference($id)->first();
        if (!$loan) {
            $notify[] = ['error', 'Invalid Loan Request'];
            return redirect()->back()->withNotify($notify);
        }
        $loan->status = 2;
        $loan->save();
        $notify[] = ['success', 'Loan Closed Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function pay(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);


        $loan = Loan::whereReference($id)->first();
        if (!$loan) {
            $notify[] = ['error', 'Invalid Loan Request.'];
            return back()->withNotify($notify);
        }

        if ($loan->status == 2) {
            $notify[] = ['error', 'Loan has already been cleared'];
            return back()->withNotify($notify);
        }
        if ($loan->status == 3) {
            $notify[] = ['error', 'Loan was rejected'];
            return back()->withNotify($notify);
        }

        $balance = $loan->total - $loan->paid;

        if ($request->amount > $balance) {
            $notify[] = ['error', 'Amount Greater Than Loan Balance'];
            return back()->withNotify($notify);
        }

        if ($balance < 1) {
            $loan->status = 2;
            $loan->save();
            $notify[] = ['success', 'Loan has been cleared.'];
            return back()->withNotify($notify);
        }



        $user = User::whereId($loan->user_id)->first();
        $loan->paid += $request->amount;
        $loan->save();

        $balance = $loan->total - $loan->paid;

        if ($balance < 1) {
            $loan->status = 2;
            $loan->save();
        }

        $code = getTrx();
        $pay = new LoanPay();
        $pay->user_id = $user->id;
        $pay->loan_id = $loan->reference;
        $pay->plan_id = $loan->plan_id;
        $pay->amount = $request->amount;
        $pay->balance = $balance;
        $pay->trx = $code;
        $pay->status = 1;
        $pay->save();

        $notify[] = ['success', 'Payment Was Successful'];
        return back()->withNotify($notify);
    }
}
