<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->take(5)
                            ->whereHas('transaction', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });
                            
        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
        ]);
        
    }
}
