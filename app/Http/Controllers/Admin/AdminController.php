<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->check()){
            return view('admin.dashboard',[
            'users' => User::latest()->filter(request(['search']))
            ->orderBy('last_seen', 'DESC')
            ->paginate(10),

            'admins' => Admin::latest()->filter(request(['search']))
            ->orderBy('last_seen', 'DESC')
            ->paginate(10)
        ]);
        }else{
            return redirect('/');
        }
    }
}
