<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\LoanPlan;
use App\Models\PlanTimer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{


    public function index(){
        
        $pageTitle = 'Investment Plans';
        $plan = Plan::latest()->paginate(getPaginate());
        $timer = PlanTimer::get();
                //  dd($timer);
        $emptyMessage = 'Data Not Found';
        return view('admin.plan.index', compact('pageTitle', 'plan', 'timer', 'emptyMessage'));
    }


    public function create(Request $request){

        $request->validate([
            'name'=> 'required|string|max:191',
            'min_amount'=> 'required|numeric|gt:0',
            'max_amount'=> 'required|numeric|gt:min_amount',
            'total_return'=> 'required|integer|gt:0',
            'interest_type'=> 'required|in:0,1',
            'interest'=> 'required|numeric|gt:0',
            'status'=> 'required|in:0,1',
            'timer'=> 'required|int',
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->timer = $request->timer;
        $plan->min_amount = $request->min_amount;
        $plan->max_amount = $request->max_amount;
        $plan->total_return = $request->total_return;
        $plan->interest_type = $request->interest_type;  //	1=>Percent, 0=>Fixed
        $plan->interest_amount = $request->interest;
        $plan->active = $request->status;
        $plan->status = $request->status;
        dd($request);
        $plan->save();

        $notify[] = ['success', 'Plan created successfully'];
        return redirect()->back()->withNotify($notify);

    }

    public function edit(Request $request){

        $request->validate([
            'id'=> 'required|exists:plans,id',
            'name'=> 'required|string|max:191',
            'min_amount'=> 'required|numeric|gt:0',
            'max_amount'=> 'required|numeric|gt:min_amount',
            'total_return'=> 'required|integer|gt:0',
            'interest_type'=> 'required|in:0,1',
            'interest'=> 'required|numeric|gt:0',
            'status'=> 'required|in:0,1',
        ]);

        $findPlan = Plan::find($request->id);
        $findPlan->name = $request->name;
        $findPlan->min_amount = $request->min_amount;
        $findPlan->max_amount = $request->max_amount;
        $findPlan->total_return = $request->total_return;
        $findPlan->interest_type = $request->interest_type;  //	1=>Percent, 0=>Fixed
        $findPlan->interest_amount = $request->interest;
        $findPlan->status = $request->status;
        $findPlan->save();

        $notify[] = ['success', 'Plan updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

     public function timer(){
         $pageTitle = 'Plan Timer';
         $timer = PlanTimer::latest()->paginate(getPaginate());
        //  dd($timer);
        $emptyMessage = 'Data Not Found';
        return view('admin.plan.timer', compact('pageTitle','timer','emptyMessage'));
    }

     public function timercreate(Request $request){

        $request->validate([
            'name'=> 'required|string|max:191',
            'slug'=> 'required|string|max:50',
            'timer'=> 'required|int',
        ]);

        $timer = new PlanTimer();
        $timer->name = $request->name;
        $timer->time = $request->timer;
        $timer->slug = $request->slug;
        $timer->save();

        $notify[] = ['success', 'Plan Timer created successfully'];
        return redirect()->back()->withNotify($notify);

    }

     public function timeredit(Request $request){
         
         $request->validate([
             'id'=> 'required',
             'name'=> 'required|string|max:191',
             'slug'=> 'required|string',
             'timer'=> 'required|numeric',
            ]);
            
            $timer = PlanTimer::find($request->id);
            // dd($timer);
        $timer->name = $request->name;
        $timer->slug = $request->slug;
        $timer->time = $request->timer;
        $timer->save();

        $notify[] = ['success', 'Plan Timer updated successfully'];
        return redirect()->back()->withNotify($notify);
    }


    public function createLoanPlan(){
        return view('admin.plan.create');
    }

    public function postLoanPlan(Request $request){
       
        $request->validate([
            'title' => 'required|string',
            'interest_type' => 'required|numeric',
            'loan_type' => 'required|string',
            'interest' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'late_fees_type' => 'required|numeric',
            'late_fees' => 'required|numeric',
        ]);


        $data = New LoanPlan();
        $input   = $request->except('_token');
        $data->fill($input)->save();

        $notify[] = ['success', 'Loan Plan Create successfully'];
        return redirect()->route('admin.plan.index')->withNotify($notify);
    }








}
