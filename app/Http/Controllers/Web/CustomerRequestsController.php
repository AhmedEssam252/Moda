<?php

namespace App\Http\Controllers\Web;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerRequestsController extends Controller
{
    public function index(){
        return view('web.customerRequests',['customerRequests'=>Checkout::latest()->filter(request(['search']))->where('user_id' , Auth::user()->id)->paginate(10)]);
    }
    public function show($id){
        $customerRequest = checkout::where('id' , $id)
        ->where('user_id' , Auth::user()->id)
        ->first();
        if($customerRequest == null){
            abort(404, 'Record not found.');
        }
        try{
        return view('web.customerRequest',['customerRequest'=> $customerRequest]);
        }catch(\Exception $e){
            return redirect()->back()->with('error2', __('lang.SomethingWentWrong'));
        }
    }

    public static function totalItems(){
        return Checkout::where('user_id' , Auth::user()->id)->count();
    }

}
