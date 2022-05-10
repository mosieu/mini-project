<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    function index()
    {
        return view('form');
    }

    function submit(Request $request)
    {
        $array = explode('/', $request->category_url);
        $categorySlug = str_replace('category-', '', $array[4]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, FALSE);
        $page=1;
        do{
            curl_setopt($ch, CURLOPT_URL, 'https://api.digikala.com/v1/categories/'.$categorySlug.'/search/?page='.$page);
            $catResult = curl_exec($ch);
            $catJson= json_decode($catResult);
            foreach ($catJson->data->products as $productItem){
                curl_setopt($ch, CURLOPT_URL, 'https://api.digikala.com/v1/product/'.$productItem->id.'/');
                $productResult = curl_exec($ch);
                $productJson= json_decode($productResult);

                $productJson->data->product->title_fa;//product title
                foreach ($productJson->data->product->images->list as $image){
                  foreach ($image->url as $url) {
                     //product image urls
                  }
                }
                foreach ($productJson->data->product->colors as $color){
                    $color->hex_code;//product colors
                }
                $productJson->data->product->review->description;//product description
                foreach ($productJson->data->product->review->attributes as $attribute){
                    $attribute->title;//product attr title
                    foreach ($attribute->values as $value){
                        //product attr values
                    }
                }
                foreach ($productJson->data->product->specifications[0]->attributes as $attribute) {
                    $attribute->title;//product attr title
                    foreach ($attribute->values as $value){
                        //product attr values
                    }
                }
                dd($productJson);

            }

            $page++;
        }while($catJson->data->pager->total_pages!=$page);

        curl_close($ch);
    }







}
