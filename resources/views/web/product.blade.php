@extends('web.layouts.master')

@section('title') {{__('admin.Products')}} @endsection

@section('styles')
<style>
    .message{
        margin: 20px;
    }
    nav{
        background:#0F8282;
        box-shadow: 2px 4px 6px rgb(37 36 36 / 37%);
        transition: 0.5s ease-in-out;
    }
</style>
<link rel="stylesheet" href="{{asset('css/web/categories.css')}}">
@endsection

@section('content')
<section id="product">

            <div class="productInfo">
                <div>
                    <h1>{{__('lang.Name')}}</h1>
                    <p>{{$product->title}}</p>
                </div>
                <div>
                    <h1>{{__('lang.Size')}}</h1>
                    <p>{{implode(',',$product->size)}}</p>
                </div>
                <div>
                    <h1>{{__('lang.price')}}</h1>
                    <p>{{$product->price}}</p>
                </div>
                <div>
                    <h1>{{__('lang.description')}}</h1>
                    <p>{{$product->description}}</p>
                </div>
                <div>
                    <h1>{{__('lang.recoveryProduct')}}</h1>
                    <p>{{$product->recovery}}</p>
                </div>
            </div>
            <div class="img">
                <img src="{{asset('storage/' . $product->image)}}" alt="accs" width="100%" height="100%" class="cloth">
                <div class="items">
                    <form action={{route('StoreProductInBag')}} method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$product->id}}">
                        <button type="submit"><img src="{{asset('img/Home/shopping-bag-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                    </form>
                    <form action={{route('StoreProductInFavorite')}} method="post">
                        @csrf
                        <input type="hidden" name="product" value="{{$product->id}}">
                        <button type="submit"><img src="{{asset('img/Home/heart-svgrepo-com.svg')}}" alt="accs" width="40" height="40" class="icon"></button>
                    </form>
                </div>
            </div>
</section>

{{-- js --}}
<script src="{{asset('js/web/favorites.js')}}"></script>
@endsection

