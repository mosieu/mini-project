<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FormController extends Controller
{
    function index()
    {
        return view('form');
    }

    function submit(Request $request)
    {
        $rules = [
            'product_url' => 'required|starts_with:https://www.digikala.com/product/dkp-',
        ];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->messages()->all());
        }

        $productId = $this->getProductIdWithUrl($request->product_url);

        $json = $this->getProductJsonWithId($productId);

       return redirect()->route('insertProduct', ['json'=>$json]);
    }



    private function getProductIdWithUrl($url){
        $subStr = str_replace("https://www.digikala.com/product/dkp-", "", $url);
        $array = explode('/', $subStr);
        $productId = $array[0];
        return $productId;
    }

    private function getProductJsonWithId($productId){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, 'https://api.digikala.com/v1/product/' . $productId);
        curl_setopt($ch, CURLOPT_POST, false);
        $results = curl_exec($ch);
        curl_close($ch);
        return json_decode($results);
    }



}
