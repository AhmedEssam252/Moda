@php
use App\Models\Product;
@endphp

@extends('web.layouts.master')

@section('title') {{ __('lang.CompleteYourPurchase') }} @endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/web/checkout.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/adminList/add.css')}}">
<link rel="stylesheet" href="{{asset('css/web/shoppingBag.css')}}">
<style>
    .title{
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        margin: 50px 0 20px 0;
    }
    .slider-content{
        position: relative;
    }
    .exist{
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin: 20px 0 20px 0;
        background: #b10000ec;
        color: #fff;
        padding: 10px 20px;
        max-width: 150px;
        border-radius: 20px;
        margin: 0 30px;
    }
    .deleted{
        display: grid;
        position: absolute;
        z-index: 1;
        top: 30px;
        margin: 0 8px;
    }
</style>
@endsection

@section('content')



<section id="Checkout">
    <h1>{{ __('lang.CompleteYourPurchase') }}</h1>
</section>

<h1 class="title">{{__('admin.Show')}} {{__('admin.Info')}}</h1>
        <table class="table" style="width:80% !important; margin: auto;">
            <thead>
                <tr>
                    <th style="border:none;">{{__('admin.Key')}}</th>
                    <td style="border:none;">{{__('admin.Value')}}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{__('admin.ID')}}</th>
                    <td>{{$customerRequest->id}}</td>
                </tr>
                <tr>
                    <th>{{__('lang.Productsquantity')}}</th>
                    <td>{{count($customerRequest->productsInfo)}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.Date')}}</th>
                    <td>{{$customerRequest->created_at}}</td>
                </tr>
                <tr>
                    <th class="thstart">{{__('admin.Status')}}</th>
                    <td>{{$customerRequest->status}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.Total')}}</th>
                    <td>{{$customerRequest->total}}</td>
                </tr>
            </tbody>
        </table>

<h1 class="title">{{__('admin.Show')}} {{__('admin.Products')}}</h1>

<section id="details">
    <div class="slider-content">
        @foreach ($customerRequest->productsInfo as $detail)
            @php
                // check if product exist in product table
                $product_id = $detail->product_id;
                $check = Product::find($product_id);
            @endphp
            <div class="bag">
                @if ($check == null)
                <div class="deleted">
                    <h1 class="exist">{{__('lang.Deleted')}}</h1>
                </div>
                @endif
                <div class="offer">
                    <img src="{{asset('storage/' . $detail->image)}}" alt="accs" width="100%" height="100%" class="cloth">
                    @if ($check != null)
                    <div class="items">
                        <form action={{route('StoreProductInBag')}} method="post">
                            @csrf
                            <input type="hidden" name="product" value="{{$detail->product_id}}">
                            <button type="submit"><img src="{{asset('img/Home/shopping-bag-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                        </form>
                        <form action={{route('StoreProductInFavorite')}} method="post">
                            @csrf
                            <input type="hidden" name="product" value="{{$detail->product_id}}">
                            <button type="submit"><img src="{{asset('img/Home/heart-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="productInfo">
                    @if(app()->getLocale() == 'ar')
                    <p class="productName">{{$detail->title->ar}}</p>
                    @elseif(app()->getLocale() == 'en')
                    <p class="productName">{{$detail->title->en}}</p>
                    @endif
                    <p class="productPrice">{{$detail->price}} {{__('lang.EGP')}}</p>
                    <p class="productQuantity">{{$detail->quantity}}</p>
                    <p class="productTotal">{{__('lang.Total')}} <br> {{$detail->price * $detail->quantity}} {{__('lang.EGP')}}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>


{{-- js --}}
@endsection
