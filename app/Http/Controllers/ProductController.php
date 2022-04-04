<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\getProductJson;
use App\Models\Product;


class ProductController extends Controller
{
    function index()
    {
        return view('form');
    }

    function submit(ProductRequest $request)
    {

        $job=new getProductJson($request->product_url);

        $json=$job->handle();

        $product=$this->insertProduct($json);

        return view('product',compact('product'));
    }


    private function insertProduct($productJson){

        $product = Product::find($productJson->id);
        if ($product == null) {
            $product = new Product();
            $product->id = $productJson->id;
            $product->title = $productJson->title_fa;
            $product->image = $productJson->images->main->url[0];
            $product->category = $productJson->data_layer->category;
            $product->save();
        }
        return $product;
    }




}
