<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\bag_product;
use App\Models\Shoppingbag;
use App\Models\Subcategory;
use App\Models\Favorite_product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\storeProductInBagRequest;
use App\Http\Requests\storeProductInFavoriteRequest;

class ProductsController extends Controller
{

    public function indexProducts(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('web.products',['products'=>Product::latest()->filter(request(['search','subcategory','size','minmum','maximum','category']))->paginate(10) ,'categories' => $categories, 'subcategories' => $subcategories]);
    }

    public function indexProduct(Product $product){
        return view('web.product',['product'=>$product]);
    }

    public function verProduct_bag(){
        return  bag_product::join('shoppingbags','shoppingbags.id','=','bag_products.shoppingbag_id')
        ->where('shoppingbags.user_id',Auth::user()->id)
        ->where('product_id', request()->product);
    }

    public function verProduct(){
        return  Product::where('id', request()->product)->first()->price;
    }
    public function AddToBag(storeProductInBagRequest $request){
        if($this->verProduct_bag()->exists()){
            $this->verProduct_bag()->increment('quantity');
            $total = $this->verProduct_bag()->first()->quantity * $this->verProduct();
            $this->verProduct_bag()->update(['total'=>$total]);
            return redirect()->back()->with('successproductIncreased', __('lang.productIncreased'));
        }

        try{
        $attributes = $request->validated();
        $id = Shoppingbag::storeInBag();
        bag_product::storeInBag($attributes,$id);
        return redirect()->back()->with('successAddToBag', __('lang.productAddedToBag'));
        }catch(\Exception $e){
            return redirect()->back()->with('errorAddToBag', __('lang.SomethingWentWrong'));
        }
    }

    public function RemoveFormBag(){
        if($this->verProduct_bag()->first() == null){
            return redirect()->back()->with('error2RemoveFromBag', __('lang.productalreadyRemovedFromBag'));
        }
        if($this->verProduct_bag()->first()->quantity > 1){
            $this->verProduct_bag()->decrement('quantity');
            return redirect()->back()->with('successproductIncreased', __('lang.productIncreased'));
        }
        try{
            $this->verProduct_bag()->delete();
            return redirect()->back()->with('successRemoveFromBag', __('lang.productRemovedFromBag'));
        }catch(\Exception $e){
            return redirect()->back()->with('errorRemoveFromBag', __('lang.SomethingWentWrong'));
        }
    }

    public function verProduct_favorite(){
        return  Favorite_product::join('favorites','favorites.id','=','favorite_products.favorite_id')
        ->where('favorites.user_id',Auth::user()->id)
        ->where('product_id', request()->product);
    }

    public function AddToFavorite(storeProductInFavoriteRequest $request){

        if($this->verProduct_favorite()->exists()){
            return redirect()->back()->with('eerrorAddToFavorite', __('lang.ProductExistInFavorites') );
        }
        try{
        $attributes = $request->validated();
        Favorite::storeInFavorite();
        Favorite_product::storeInFavorite($attributes);

        return redirect()->back()->with('successAddToFavorite', __('lang.productAddedToFavorites'));
        }catch(\Exception $e){
            return redirect()->back()->with('errorAddToFavorite', __('lang.SomethingWentWrong'));
        }
    }
    public function RemoveFormFavorite(){
        if($this->verProduct_favorite()->first() == null){
            return redirect()->back()->with('error2RemoveFromBag', __('lang.productalreadyRemovedFromFavorites'));
        }
        try{
            $this->verProduct_favorite()->delete();
        return redirect()->back()->with('successRemoveFromFavorite', __('lang.productRemovedFromFavorites'));
        }catch(\Exception $e){
            return redirect()->back()->with('errorRemoveFromFavorite', __('lang.SomethingWentWrong'));
        }
    }
}
