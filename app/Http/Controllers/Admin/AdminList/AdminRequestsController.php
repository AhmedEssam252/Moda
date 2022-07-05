<?php

namespace App\Http\Controllers\Admin\AdminList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Rap2hpoutre\FastExcel\FastExcel;

class AdminRequestsController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query){
        //     logger($query->sql);
        // });

        return view('admin.requests.index',['customerRequests' => Checkout::latest()->filter(request(['search']))->paginate(15)]);
    }

    public function show($id){
        $customerRequest = checkout::where('id' , $id)->first();
        return view('admin.requests.info',['customerRequest'=>$customerRequest]);
    }

    public function edit($id)
    {
        $customerRequest = checkout::where('id' , $id)->first();
        return view('admin.requests.edit',['customerRequest' => $customerRequest]);
    }

    public function update(Request $request ,$id)
    {
        try {
            $attributes = $request->validate([
                'status' => 'required',
            ]);
            $customerRequest = checkout::where('id' , $id)->first();
            Checkout::updateThing($attributes, $customerRequest);
            return redirect('/admin/requests')->with('updateSuccess', __('admin.RequestUpdatedSuccessfully'));
        }catch (\Exception $e) {
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public function downloadcsv()
    {
        return (new FastExcel(Checkout::all()))->download('CustomarRequests.csv');

    }
    public function downloadxlsx()
    {
        return (new FastExcel(Checkout::all()))->download('CustomarRequests.xlsx');

    }
}
