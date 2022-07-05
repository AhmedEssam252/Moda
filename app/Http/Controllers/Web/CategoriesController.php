<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(Category $category)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::where('category_id', $category->id)->latest()->filter(request(['search','subcategory','size','minmum','maximum']))->paginate(15);
        return view('web.categories',['category' => $category, 'products' => $products, 'categories' => $categories, 'subcategories' => $subcategories]);
    }
}
