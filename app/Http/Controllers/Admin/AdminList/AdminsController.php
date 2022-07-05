<?php

namespace App\Http\Controllers\Admin\AdminList;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminsController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query){
        //     logger($query->sql);
        // });

        return view('admin.accounts.admin.index',['admins' => Admin::latest()->filter(request(['search']))
        ->orderBy('last_seen', 'DESC')
        ->paginate(15)]);
    }

    public function create()
    {
        return view('admin.accounts.admin.create',['admins' => Admin::all()]);
    }
    public function store(StoreAdminRequest $request){
        try {
            $attributes = $request->validated();
            Admin::create($attributes);
            return redirect()->back()->with('storeSuccess', __('admin.AdminCreatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function show(Admin $admin){
        return view('admin.accounts.admin.info',['admin'=>$admin]);
    }

    public function edit(Admin $admin)
    {
        return view('admin.accounts.admin.edit',['admin' => $admin]);
    }

    public function update(UpdateAdminRequest $request ,Admin $admin)
    {

        try {
            $attributes = $request->validated();
            Admin::updateCategory($admin,$attributes);
            return redirect('/admin/account/admins')->with('updateSuccess', __('admin.AdminUpdatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return redirect()->back()->with('softDeleteSuccess' , __('admin.AdminTrachedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }

    }

    public function softDelete()
    {
        return view('admin.accounts.admin.softDelete',['admins' => Admin::onlyTrashed()->latest()->filter(request(['search']))->paginate(15)]);

    }

    public function showSoftDelete(Admin $admin)
    {
        return view('admin.accounts.admin.info',['admin'=>$admin]);
    }

    public function restore($id){
        try {
        Admin::withTrashed()
        ->where('id',$id)
        ->restore();
        return redirect()->back()->with('restoresuccess' , __('admin.AdminRestoredSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function forceDelete($id)
    {
        try {
        Admin::withTrashed()
        ->where('id',$id)
        ->forceDelete();
        return redirect()->back()->with('forceDeleteSuccess' , __('admin.AdminDeletedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }
    public function downloadcsv()
    {
        return (new FastExcel(Admin::all()))->download('Admins.csv');

    }
    public function downloadxlsx()
    {
        return (new FastExcel(Admin::all()))->download('Admins.xlsx');

    }
}
