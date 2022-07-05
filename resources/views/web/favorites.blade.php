@extends('web.layouts.master')

@section('title') {{ __('lang.Favorites') }} @endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/web/favorites.css')}}">
@endsection


@section('content')

<section id="Favorites">
    <h1>{{ __('lang.Favorites') }}</h1>
</section>

<section id="details">
    <div class="slider-content">
        @if ($favorite_products->count() == 0)
        <h1>{{__('lang.noFavorite')}}</h1>
        @else
        @foreach ($favorite_products as $favorite_product)
        <div class="bag">
            <div class="offer">
                <img src="{{asset('storage/' . $favorite_product->product->image)}}" alt="accs" width="100%" height="100%" class="cloth">
                <div class="items">
                    <form action={{route('RemoveProductFromFavorite')}} method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$favorite_product->product->id}}">
                        <button type="submit"><img src="{{asset('img/Favorites/remove-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                    </form>
                    <form action={{route('StoreProductInBag')}} method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$favorite_product->product->id}}">
                        <button type="submit"><img src="{{asset('img/Home/shopping-bag-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</section>
@if ($favorite_products->count() !== 0)
<section class="fixedButtons">
    <button>{{ __('lang.AddAllToShoppingBag') }}</button>
    <button>{{ __('lang.RemoveAllFavorites') }}</button>
</section>
@endif
{{-- js --}}
<script src="{{asset('js/web/favorites.js')}}"></script>
@endsection

