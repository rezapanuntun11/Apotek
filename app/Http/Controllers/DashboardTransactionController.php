<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TransactionDetail;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $buyTransactions = Transaction::with(['transactiondetails.product.galleries'])
            ->where('users_id', Auth::user()->id)
            ->latest()->get();
        // dd($buyTransactions);
        return view('pages.dashboard-transactions', [
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = Transaction::with(['transactiondetails.product.galleries'])
            ->findOrFail($id);
        return view('pages.dashboard-transactions-details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details', $id);
    }
}
