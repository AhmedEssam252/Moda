
@extends('web.layouts.master')

@section('title') {{$category->title}} @endsection

@section('styles')
<style>
    #categories{
    background:url("{{asset('storage/' . $category->image)}}") no-repeat center center fixed;
    }
    .message{
        margin: 20px;
    }
</style>
<link rel="stylesheet" href="{{asset('css/web/categories.css')}}">
@endsection

@section('content')

<section id="categories">
    <h1>{{$category->title}}</h1>
</section>

<section id="details">
<div class="All-Filters">
        <form method="get" action="#" class="filterBar" >
           <select name="subcategory" id="subcategoryFilter" onchange="this.form.submit()">
               <option value={{__('admin.SubCategory')}} selected disabled>{{__('admin.SubCategory')}}</option>
               @foreach ($subcategories as $subcategory)
                   <option value="{{$subcategory->route}}">{{$subcategory->title}}</option>
               @endforeach
          </select>
        </form>
        <form method="get" action="#" class="filterBar" >
            <select name="size" id="size" onchange="this.form.submit()">
                <option value="size"selected disabled>{{__('lang.Size')}}</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL" >XL</option>
                <option value="XXL">XXL</option>
           </select>
         </form>
         <form method="get" action="#" class="filterBar">
            <h1>{{__('lang.filterPrice')}}</h1>
            <input type="number" name="minmum" placeholder="{{__('lang.minmum')}}" required>
            <input type="number" name="maximum" placeholder="{{__('lang.maximum')}}" required>
            <input type="submit" value="{{__('lang.filter')}}">
         </form>
    </div>
    <div class="slider-content">
        @if ($products->count() == 0)
        <h1>{{__('lang.noProducts')}}</h1>
        @else
        @foreach ($products as $product)
            <div class="offer">
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
                <h1>{{$product->title}}</h1>
                <p>{{$product->price . ' ' . __('lang.EGP')}}</p>
                <a href={{route('Product', $product->route)}}>{{ __('lang.Details') }}</a>
            </div>
        @endforeach
        @endif
    </div>
    {{$products->links('pagination::bootstrap-5')}}
</section>
{{-- js --}}
<script src="{{asset('js/web/favorites.js')}}"></script>
@endsection

