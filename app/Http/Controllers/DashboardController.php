<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['transactiondetails.product.galleries'])
            ->where('users_id', Auth::user()->id)
            ->latest()->take(5);

        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
        ]);
    }
}
