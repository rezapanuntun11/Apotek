<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class RajaOngkirController extends Controller
{
    public function check(Request $request)
    {
        $destination = $request->destination;
        $courier = $request->courier;
        $response = Http::withHeaders(['key'=>'320a8cc242375f3a230db7950ee0b8ec'])->post('https://api.rajaongkir.com/starter/cost',[
            "origin"=>  501,
            "destination"=> $destination,
            "weight"=> 1000,
            "courier"=>  $courier,
        ]);
    
        return $response->json();
    }
    public function courier(Request $request)
    {
        
        $response = [
            ['code'=>'jne',
            'name'=>'Jalur Nugraha Ekakurir (JNE)'    
            ],
            [
            'code'=>'pos',
            'name'=>'POS Indonesia (POS)' 
            ]
            
        ];
   
        return response()->json($response);
    }
    public function provinces()
    {
        $response = Http::withHeaders(['key'=>'320a8cc242375f3a230db7950ee0b8ec'])->get('https://api.rajaongkir.com/starter/province');
  
        $check = $response->json();
        $provinces = $check['rajaongkir']['results'];
        
        return collect($provinces);
    }
    public function cities($id)
    {
        $response = Http::withHeaders(['key'=>'320a8cc242375f3a230db7950ee0b8ec'])->get('https://api.rajaongkir.com/starter/city',
    [
        'province'=>$id
    ]);
    $check = $response->json();
   
    $city = $check['rajaongkir']['results'];
    
    return collect($city);
    }
}