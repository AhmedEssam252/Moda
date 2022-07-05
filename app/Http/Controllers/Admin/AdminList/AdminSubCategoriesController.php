<?php

namespace App\Http\Controllers\Admin\AdminList;

use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;


class AdminSubCategoriesController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query){
        //     logger($query->sql);
        // });
        $subcategories = Subcategory::with('category')->latest()->filter(request(['search','category']))->paginate(15);
        return view('admin.subCategories.index',['subcategories' => $subcategories,'categories'=> Category::all()]);
    }

    public function create()
    {
        return view('admin.subCategories.create',['categories' => Category::all()]);
    }
    public function store(StoreSubCategoryRequest $request){
        if(Subcategory::where('title->ar', request()->ArabicName)
        ->where('title->en', request()->EnglishName)
        ->where('category_id', request()->categoryName)->exists()
        ){
            return redirect()->back()->with('storeError', __('admin.NameIsAlreadyTakenInSameCategory'));
        }
        try {
            $attributes = $request->validated();
            Subcategory::create($attributes);
            return redirect()->back()->with('storeSuccess', __('admin.subCategoryCreatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function show(Subcategory $subcategory){
        return view('admin.subCategories.info',['subcategory'=>$subcategory]);
    }

    public function edit(Subcategory $subcategory)
    {
        return view('admin.subCategories.edit',['subcategory' => $subcategory ,'categories' => Category::all()]);
    }

    public function update(UpdateSubCategoryRequest $request ,Subcategory $subcategory)
    {
        if(Subcategory::where('title->ar', request()->ArabicName)
        ->where('title->en', request()->EnglishName)
        ->where('category_id', request()->categoryName)
        ->where('id','!=',$subcategory->id)->exists()){
            return redirect()->back()->with('storeError', __('admin.NameIsAlreadyTakenInSameCategory'));
        }
        if($request->hasFile('upload_image')){
            $request->validate([
                'upload_image.*' => 'image|max:2048',
            ]);
        }
        try {
            $attributes = $request->validated();
            Subcategory::updateCategory($subcategory,$attributes);
            return redirect('/admin/subCategories')->with('updateSuccess', __('admin.subCategoryUpdatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect('/admin/subCategories')->back()->with('error2', __('lang.SomethingWentWrong') . ' & ' . __('admin.NameOrRouteIsAlreadyTaken'));
        }
    }

    public function destroy(Subcategory $subcategory)
    {
        try {
            $subcategory->delete();
            return redirect()->back()->with('softDeleteSuccess' , __('admin.subCategoryTrachedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }

    }

    public function softDelete()
    {
        return view('admin.subCategories.softDelete',['subcategories' => Subcategory::onlyTrashed()->with('category')->latest()->filter(request(['search','category']))->paginate(15),'categories'=> Category::all()]);

    }

    public function showSoftDelete(Subcategory $subcategory)
    {
        return view('admin.subCategories.info',['subcategory'=>$subcategory]);
    }

    public function restore($route){
        try {
        Subcategory::withTrashed()
        ->where('route',$route)
        ->restore();
        return redirect()->back()->with('restoresuccess' , __('admin.subCategoryRestoredSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function forceDelete($route)
    {
        try {
        Subcategory::withTrashed()
        ->where('route',$route)
        ->forceDelete();
        return redirect()->back()->with('forceDeleteSuccess' , __('admin.subCategoryDeletedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }
    public function downloadcsv()
    {
        return (new FastExcel(Subcategory::all()))->download('SubCategories.csv');

    }
    public function downloadxlsx()
    {
        return (new FastExcel(Subcategory::all()))->download('SubCategories.xlsx');

    }

}
