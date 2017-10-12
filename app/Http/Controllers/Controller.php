<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

    }

    public function home(Request $request)
    {
        $products=  Product::all();


        return view('home')->with(compact('products'));
    }

    public function newProduct(Request $request)
    {
        $product = new Product();
        $product->naam = $request->get('naam');
        $product->checked = $request->get('checked');

        $product->save();
    }

    public function post(Request $request, $id)
    {

        $product = Product::find($id);
        $product->checked = $request->get('checked');
        if ($request->has('naam'))
            $product->naam = $request->get('naam');
        $product->update();

//        dd(Request::get('product.naam'));
//        return json_decode($request->get('payload'));

    }


    public function remove($id)
    {
        $product = Product::find($id);

        $product->delete();
    }

}
