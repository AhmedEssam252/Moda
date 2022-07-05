@extends('web.layouts.master')

@section('title') {{ __('lang.ShoppingBag') }} @endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/web/shoppingBag.css')}}">
@endsection

@section('content')


<section id="ShoppingBag">
    <h1>{{ __('lang.ShoppingBag') }}</h1>
</section>
<section id="details">
    <div class="slider-content">
        @if ($Shoppingbags->count() == 0)
           <h1 style="text-align: center;">{{__('lang.noshopingBag')}}</h1>
        @else
        @foreach ($Shoppingbags as $Shoppingbag)
        <div class="bag">
            <div class="offer">
                <img src="{{asset('storage/' . $Shoppingbag->product->image)}}" alt="accs" width="100%" height="100%" class="cloth">
                <div class="items">
                    <form action={{route('RemoveProductFromBag')}} method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$Shoppingbag->product->id}}">
                        <button type="submit"><img src="{{asset('img/Favorites/remove-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                    </form>
                    <form action={{route('StoreProductInFavorite')}} method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$Shoppingbag->product->id}}">
                        <button type="submit"><img src="{{asset('img/Home/heart-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                    </form>
                </div>
            </div>
            <div class="productInfo">
                @php
                @endphp
                <p class="productName">{{$Shoppingbag->product->title}}</p>
                <p class="productPrice">{{$Shoppingbag->product->price}} {{__('lang.EGP')}}</p>
                <p class="productQuantity">{{$Shoppingbag->quantity}}</p>
                <p class="productTotal">{{__('lang.Total')}} <br> {{$Shoppingbag->product->price * $Shoppingbag->quantity}} {{__('lang.EGP')}}</p>
            </div>


        </div>
        @endforeach

        @php
             $total =  $Shoppingbags->sum('total')
        @endphp
        <h1 style="text-align: center;">{{__('lang.Total')}}</h1>
         <h1 style="text-align: center;">{{$total}} {{__('lang.EGP')}}</h1>
        @endif
    </div>
    {{$Shoppingbags->links('pagination::bootstrap-5')}}
</section>
@if ($Shoppingbags->count() !== 0)
<section class="fixedButtons">
    <a href="{{route('Checkout')}}">{{ __('lang.CompleteYourPurchase') }}</a>
    <a href="">{{ __('lang.RemoveAllProducts') }}</a>
</section>
@endif
{{-- js --}}
<script src="{{asset('js/web/shoppingBag.js')}}"></script>
@endsection
