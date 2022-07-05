<?php

namespace App\Http\Controllers\Web;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeCheakoutRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('web.checkout');
    }
    public function store(storeCheakoutRequest $request)
    {
       $attributes = $request->validated();
       Checkout::create($attributes);
       return redirect()->back()->with('storeRequestSuccess', __('admin.CheckoutCreatedSuccessfully' ));
    }
}
