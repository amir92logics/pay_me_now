<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $pageTitle = 'Banks list';
        $banks = Bank::latest()->get();
        return view('admin.banks.index', compact('pageTitle', 'banks'));
    }

    public function create()
    {
        $pageTitle = 'Create Bank';
        return view('admin.banks.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        Bank::create($request->all());
        return response()->json([
            'redirect' => route('admin.banks.index'),
            'message' => "Bank create successfully",
        ]);
    }

    public function show(Bank $bank)
    {
        //
    }

    public function edit(Bank $bank)
    {
        $pageTitle = 'Update Bank';
        return view('admin.banks.edit', compact('bank', 'pageTitle'));
    }

    public function update(Request $request, Bank $bank)
    {
        $bank->update($request->all());
        return response()->json([
            'redirect' => route('admin.banks.index'),
            'message' => "Bank updated successfully",
        ]);
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return back()->with('success', __('Bank deleted successfully'));
    }
}
