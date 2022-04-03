<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index($productId)
    {
        $product = Product::find($productId);
        return view('product', compact('product'));
    }

    function insert($json)
    {
        dd($json);
        $product = Product::find($productJson->id);
        if ($product == null) {
            $product = new Product();
            $product->id = $productJson->id;
            $product->title = $productJson->title_fa;
            $product->image = $productJson->images->main->url[0];
            $product->category = $productJson->data_layer->category;
            $product->save();
        }

        return redirect()->route('product',['$productId'=>$product->id]);

    }




}
