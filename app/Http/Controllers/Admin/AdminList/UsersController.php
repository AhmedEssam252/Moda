<?php

namespace App\Http\Controllers\Admin\AdminList;

use App\Models\User;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query){
        //     logger($query->sql);
        // });

        return view('admin.accounts.users.index',['users' => User::latest()->filter(request(['search']))
        ->orderBy('last_seen', 'DESC')
        ->paginate(10)]);
    }

    public function create()
    {
        return view('admin.accounts.users.create',['users' => User::all()]);
    }
    public function store(StoreUserRequest $request){
        try {
            $attributes = $request->validated();
            User::create($attributes);
            return redirect()->back()->with('storeSuccess', __('admin.UserCreatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function show(User $user){
        return view('admin.accounts.users.info',['user'=>$user]);
    }

    public function edit(User $user)
    {
        return view('admin.accounts.users.edit',['user' => $user]);
    }

    public function update(UpdateUserRequest $request ,User $user)
    {

        try {
            $attributes = $request->validated();
            User::updateCategory($user,$attributes);
            return redirect('/admin/account/users')->with('updateSuccess', __('admin.UserUpdatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('softDeleteSuccess' , __('admin.UserTrachedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }

    }

    public function softDelete()
    {
        return view('admin.accounts.users.softDelete',['users' => User::onlyTrashed()->latest()->filter(request(['search']))->paginate(15)]);

    }

    public function showSoftDelete(User $user)
    {
        return view('admin.accounts.users.info',['user'=>$user]);
    }

    public function restore($id){
        try {
        User::withTrashed()
        ->where('id',$id)
        ->restore();
        return redirect()->back()->with('restoresuccess' , __('admin.UserRestoredSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function forceDelete($id)
    {
        try {
        User::withTrashed()
        ->where('id',$id)
        ->forceDelete();
        return redirect()->back()->with('forceDeleteSuccess' , __('admin.UserDeletedSuccessfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }
    public function downloadcsv()
    {
        return (new FastExcel(User::all()))->download('Users.csv');

    }
    public function downloadxlsx()
    {
        return (new FastExcel(User::all()))->download('Users.xlsx');

    }
}
