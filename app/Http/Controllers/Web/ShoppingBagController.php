<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\bag_product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppingBagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function var_Shoppingbags(){
        return bag_product::join('shoppingbags','shoppingbags.id','=','bag_products.shoppingbag_id')
        ->join('products','products.id','=','bag_products.product_id')
        ->where('deleted_at', '=', null)
        ->where('shoppingbags.user_id',Auth::user()->id);
    }

    public function var_Product(){
        return Product::join('bag_products','bag_products.product_id','=','products.id')
        ->join('shoppingbags','shoppingbags.id','=','bag_products.shoppingbag_id')
        ->where('shoppingbags.user_id',Auth::user()->id);
    }

    public function index()
    {
        return view('web.shoppingBag' , ['Shoppingbags' => $this->var_Shoppingbags()->paginate(10)]);
    }

    public static function totalItems(){
         return bag_product::join('shoppingbags','shoppingbags.id','=','bag_products.shoppingbag_id')
        ->join('products','products.id','=','bag_products.product_id')
        ->where('deleted_at', null)
        ->where('shoppingbags.user_id',Auth::user()->id)
        ->count();
    }

}
