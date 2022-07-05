<?php

namespace App\Http\Controllers\Admin\AdminList;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoriesAdminController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query){
        //     logger($query->sql);
        // });
        return view('admin.categories.index',['categories' => Category::latest()->filter(request(['search']))->paginate(15)]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(StoreCategoryRequest $request){
        if(Category::where('title->ar', request()->ArabicName)->orWhere('title->en', request()->EnglishName)->exists()){
            return redirect()->back()->with('storeError', __('admin.NameIsAlreadyTaken'));
        }
        try {
            $attributes = $request->validated();
            Category::create($attributes);
            return redirect()->back()->with('storeSuccess', __('admin.CategoryCreatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show(Category $category){
        return view('admin.categories.info',['category'=>$category]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request ,Category $category)
    {
        if(Category::where('title->ar', request()->ArabicName)
        ->where('title->en', request()->EnglishName)
        ->where('id','!=',$category->id)->exists()
        ){
            return redirect()->back()->with('storeError', __('admin.NameIsAlreadyTaken'));
        }
        if($request->hasFile('upload_image')){
            $request->validate([
                'upload_image.*' => 'image|max:2048',
            ]);
        }
        try {
            $attributes = $request->validated();
            Category::updateCategory($category,$attributes);
            return redirect('/admin/categories')->with('updateSuccess', __('admin.CategoryUpdatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong') . ' & ' . __('admin.NameOrRouteIsAlreadyTaken'));
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->back()->with('softDeleteSuccess' , __('admin.CategoryTrachedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorAddToBag', __('lang.SomethingWentWrong'));
        }

    }

    public function softDelete()
    {
        return view('admin.categories.softDelete',['categories' => Category::onlyTrashed()->latest()->filter(request(['search']))->paginate(15)]);

    }

    public function showSoftDelete(Category $category)
    {
        return view('admin.categories.info',['category'=>$category]);
    }

    public function restore($route){
        try {
        Category::withTrashed()
        ->where('route',$route)
        ->restore();
        return redirect()->back()->with('restoresuccess' , __('admin.CategoryRestoredSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorAddToBag', __('lang.SomethingWentWrong'));
        }
    }

    public function forceDelete($route)
    {
        try {
        Category::withTrashed()
        ->where('route',$route)
        ->forceDelete();
        return redirect()->back()->with('forceDeleteSuccess' , __('admin.CategoryDeletedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorAddToBag', __('lang.SomethingWentWrong'));
        }
    }
    public function downloadcsv()
    {
        return (new FastExcel(Category::all()))->download('Categories.csv');

    }
    public function downloadxlsx()
    {
        return (new FastExcel(Category::all()))->download('Categories.xlsx');

    }

}
