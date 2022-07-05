<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('web.home',['categories' => Category::paginate(3),'products3' => Product::paginate(3),'products4' => Product::where('subcategory_id', 18)->paginate(3)]);
    }

    public function getsearch(){
        return view('web.search',['products'=> Product::latest()->filter(request(['search']))->paginate(15)]);
    }

    public function returnBack(){
        return redirect('/');
    }
}
