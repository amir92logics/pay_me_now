<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class CashDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Cash deposit settings';
        $cash_deposite = Option::where('key', 'cash_deposit')->first()->value ?? '';
        return view('admin.cash-deposit.index',compact('cash_deposite', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cash_deposit' => 'required|string'
        ]);

        $option = Option::where('key', 'cash_deposit')->first();
        if ($option) {
            $option->value = $request->cash_deposit;
            $option->save();
        } else {
            Option::create([
                'key' => 'cash_deposit',
                'value' => $request->cash_deposit,
            ]);
        }

        return response()->json([
            'message' => 'Cash deposit settings updated successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
