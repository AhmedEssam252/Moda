<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @if(app()->getLocale() == 'ar')
        dir="rtl"
    @else
        dir="ltr"
    @endif>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{__('lang.Moda')}} | {{ __('lang.Home') }}</title>
        <link rel="stylesheet" href="{{asset("css/web/header-footer.css")}}">
        <link rel="stylesheet" href="{{asset("css/web/necessary.css")}}">
        <link rel="stylesheet" href="{{asset("css/web/search.css")}}">
        @if(app()->getLocale() == 'ar')
        <style>
            .message {
                right: 10px;
            }
        </style>
        @endif
        @if(app()->getLocale() == 'en')
        <style>
            nav.change .otherItems {
                border-radius: 10px 0 0 10px;
            }
            .prev, .next {
                direction: rtl;
            }
            .message {
                left: 10px;
            }
        </style>
        @endif
        @yield('styles')
    </head>
    <body>
 {{-- search --}}
 <section id="searchpage">
    <div class="topSearch">
          <h1>{{__('lang.Moda')}}</h1>
            <a class="back" href={{route('Back')}}><img src="{{asset('img/Home/back-svgrepo-com.svg')}}" alt="back" width="50" height="50"></a>
    </div>
    <div class="getSearch">
         <h1>{{__('lang.SearchAboutProduct')}}</h1>
        <form style="position: relative;width: 80%;">
         <input type="text" name="search" class="search" >
        <button type="submit">{{__('lang.search')}}</button>
        </form>
    </div>

    <div id="details">
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
                <p>22 p.e</p>
                <a href={{route('Product', $product->route)}}>{{ __('lang.Details') }}</a>
            </div>

        @endforeach
        @endif
    </div>
    </div>
 </section>
       {{-- js --}}
       <script src="{{asset("js/web/header-footer.js")}}"></script>
    </body>
    </html>
