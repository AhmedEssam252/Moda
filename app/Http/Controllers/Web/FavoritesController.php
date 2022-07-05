<?php

namespace App\Http\Controllers\Web;

use App\Models\Favorite;
use App\Models\Favorite_product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{

    public function var_Favorites(){
        return Favorite_product::join('favorites','favorites.id','=','favorite_products.favorite_id')
        ->join('products','products.id','=','favorite_products.product_id')
        ->where('deleted_at', '=', null)
        ->where('favorites.user_id',Auth::user()->id);
    }
    public function index()
    {
        return view('web.favorites' ,['favorite_products' => $this->var_Favorites()->get()]);
    }
    public static function totalItems(){
        return Favorite_product::join('favorites','favorites.id','=','favorite_products.favorite_id')
        ->join('products','products.id','=','favorite_products.product_id')
        ->where('deleted_at', '=', null)
        ->where('favorites.user_id',Auth::user()->id)->count();
    }
}
