<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Transaction;
use App\TransactionDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');
        $transaction = Transaction::count();

        $transactions = Transaction::with(['transactiondetails.product.galleries'])->latest()->take(5)
            ->get();

        return view('pages.admin.dashboard', [
            'transaction_data' => $transactions,
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction
        ]);
    }
}
