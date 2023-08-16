<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws  = Withdrawal::with('method')->latest()->paginate();
        return view('user.user.withdraw.log', compact('withdraws'));
    }
}
