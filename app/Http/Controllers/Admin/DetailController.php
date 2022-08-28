<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries'])->where('slug', $id)->firstOrFail();

        return view('pages.detail', [
            'product' => $product
        ]);
    }

    public function add(Request $request, $id)
    {
        $carts = Cart::where('products_id', $id)->where('users_id', Auth::user()->id)->first();
        if ($carts) {
            $carts->increment('quantity', request()->quantity);
        } else {

            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id,
                'quantity' => request()->quantity
            ];

            Cart::create($data);
        }

        return redirect()->route('cart');
    }
}
