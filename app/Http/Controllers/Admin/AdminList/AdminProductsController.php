<?php

namespace App\Http\Controllers\Admin\AdminList;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class AdminProductsController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query){
        //     logger($query->sql);
        // });

        return view('admin.products.index',['products' => Product::with('subcategory')->latest()->filter(request(['search','category','subcategory']))->paginate(15),'categories' => Category::all(),'subcategories'=> Subcategory::all()]);
    }

    public function create()
    {
        return view('admin.products.create',['categories' => Category::all(),'subcategories'=> Subcategory::all()]);
    }
    public function store(StoreProductRequest $request){
        if(Product::where('title->ar', request()->ArabicName)
        ->where('title->en', request()->EnglishName)
        ->where('subcategory_id', request()->SubCategory)->exists()){
            return redirect()->back()->with('storeError', __('admin.NameIsAlreadyTaken'));
        }
        if(request()->size == null){
            return redirect()->back()->with('errorSize', __('admin.pleaseChooseSize'));
        }
        try {
            $attributes = $request->validated();
            Product::create($attributes);
            return redirect()->back()->with('storeSuccess', __('admin.ProductCreatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function show(Product $product){
        return view('admin.products.info',['product'=>$product]);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit',['product' => $product ,'categories' => Category::all(),'subcategories'=> Subcategory::all()]);
    }

    public function update(UpdateProductRequest $request ,Product $product)
    {
        if(Product::where('title->ar', request()->ArabicName)
        ->Where('title->en', request()->EnglishName)
        ->where('id','!=',$product->id)->exists()){
            return redirect()->back()->with('NameError', __('admin.NameIsAlreadyTaken'));
        }
        if($request->hasFile('upload_image')){
            $request->validate([
                'upload_image.*' => 'image|max:2048',
            ]);
        }
        try {
            $attributes = $request->validated();
            Product::updateCategory($product,$attributes);
            return redirect('/admin/Products')->with('updateSuccess', __('admin.ProductUpdatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->with('softDeleteSuccess' , __('admin.ProductTrachedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }

    }

    public function softDelete()
    {
        return view('admin.products.softDelete',['products' => Product::onlyTrashed()->with('subcategory')->latest()->filter(request(['search','category','subcategory']))->paginate(15),'categories' => Category::all(),'subcategories'=> Subcategory::all()]);

    }

    public function showSoftDelete(Product $product)
    {
        return view('admin.products.info',['product'=>$product]);
    }

    public function restore($route){
        try {
        Product::withTrashed()
        ->where('route',$route)
        ->restore();
        return redirect()->back()->with('restoresuccess' , __('admin.ProductRestoredSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function forceDelete($route)
    {
        try {
        Product::withTrashed()
        ->where('route',$route)
        ->forceDelete();
        return redirect()->back()->with('forceDeleteSuccess' , __('admin.ProductDeletedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }
    public function downloadcsv()
    {
        return (new FastExcel(Product::all()))->download('Products.csv');

    }
    public function downloadxlsx()
    {
        return (new FastExcel(Product::all()))->download('Products.xlsx');

    }

}
