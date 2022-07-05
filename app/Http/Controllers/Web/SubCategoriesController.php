<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class SubCategoriesController extends Controller
{
    public function index(Subcategory $subcategory)
    {
        $products = Product::where('subcategory_id', $subcategory->id)->latest()->filter(request(['search','size','minmum','maximum','category']))->paginate(15);
        return view('web.subCategories',['subcategory' => $subcategory, 'products' => $products, 'categories' => Category::all()]);
    }
}
