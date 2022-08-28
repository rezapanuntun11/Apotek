<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        return Province::all();
    }

    public function regencies(Request $request, $provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->get();
    }

    public function checkOngkir(Request $request)
    {
        return Auth::user();
        $cart = Cart::where('users_id', Auth::user()->id)->count();
        $cost =  RajaOngkir::ongkosKirim([
            'origin' => 501, //ID kota / Kabupaten asal/ 501 adalah kode kota Sragen
            'destination' => $request->city_destination, //Id Kota //kabupaten tujuan
            'weight' => $cart > 10 ? 200 : 100, // berat barang dalam gram sample 100
            'couriers' => $request->couriers // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json([
            'success' => true,
            'weight' => $cart > 10 ? 200 : 100,
            'message' => 'List Data Cost All Courir: ' . $request->couriers,
            'data'    => $cost
        ]);
    }
}
