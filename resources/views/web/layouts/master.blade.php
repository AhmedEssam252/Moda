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
        <title> {{__('lang.Moda')}} | @yield('title') </title>
        <link rel="stylesheet" href="{{asset("css/web/header-footer.css")}}">
        <link rel="stylesheet" href="{{asset("css/web/necessary.css")}}">
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
            {{-- get num of products in bag ot favorite from controller --}}
            @php
                use App\Http\Controllers\Web\ShoppingBagController;
                use App\Http\Controllers\Web\FavoritesController;
                use App\Http\Controllers\Web\CustomerRequestsController;
                use App\Models\Category;
                if(Auth::user() !== null){
                    $totalBag = ShoppingBagController::totalItems();
                    $totalFavorite = FavoritesController::totalItems();
                    $totalCustomerRequest = CustomerRequestsController::totalItems();
                    $categories = Category::paginate(5);

                }
            @endphp
        {{-- navbar --}}
        @if (Route::has('login'))
        <nav class="firstNav">
            {{-- logo --}}
            <div class="brand">
                <a href={{route('Home')}}><h1>{{__('lang.Moda')}}</h1></a>
            </div>
            {{-- login, register and logout --}}
            <div class="Auth">
                @auth
                <!-- Authentication -->
                <div class="manageAccount">
                    <p>{{__('lang.Welcome') . ' ' . Auth::user()->first_name}}</p>
                    <img src="{{asset('img/Home/person.png')}}" alt="manageAccount" width="30px" height="30px">
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('lang.Logout') }}
                    </x-dropdown-link>
                </form>
                @else
                    <a href="{{ route('login') }}">{{ __('lang.Login') }}</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" >{{ __('lang.SignUp') }}</a>
                    @endif
                @endauth

            </div>
            <div class="otherItems">
                <a href="{{route('Search')}}"><img src="{{asset('img/Home/search-svgrepo-com.svg')}}" alt="search" width="30px" height="30px"></a>
                <a href="{{route('CustomerRequests')}}" class="request"><div class="itemIcon"><div class="numOfProduct">@if(Auth::user() !== null) {{$totalCustomerRequest}} @else 0 @endif</div></div></a>
                <a href={{route('Favorites')}} class="favorate"><div class="itemIcon"><div class="numOfProduct">@if(Auth::user() !== null) {{$totalFavorite}} @else 0 @endif</div></div></a>
                <a href={{route('ShoppingBag')}} class="cart"><div class="itemIcon"><div class="numOfProduct">@if(Auth::user() !== null) {{$totalBag}} @else 0 @endif</div></div></a>
                <div class="selectLang">
                    <button onclick="myFunction3()">{{ __('lang.lang') }}</button>
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li><a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
            </div>
            <div class="lists">
                <ul>
                    {{-- @foreach ($categories as $category)
                        <li><a href="{{route('Category',$category->route)}}">{{$category->title}}</a></li>
                    @endforeach --}}
                    <li><a href="/categories/men">{{__('lang.Men')}}</a></li>
                    <li><a href="/categories/women">{{__('lang.Women')}}</a></li>
                    <li><a href="/categories/children">{{__('lang.Children')}}</a></li>
                    <li><a href="/products">{{__('admin.Products')}}</a></li>
                </ul>
            </div>
            <div id="toggle" onclick="myFunction(this)">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
        @endif
        {{-- messages --}}
        <div class="message">
            @if(session()->has('successAddToBag'))
                <div class="success">
                    {{session()->get('successAddToBag')}}
                </div>
            @elseif(session()->has('error2RemoveFromBag'))
            <div class="fail">
                {{session()->get('error2RemoveFromBag')}}
            </div>
            @elseif(session()->has('successproductIncreased'))
            <div class="success">
                {{session()->get('successproductIncreased')}}
            </div>
           @elseif(session()->has('errorAddToBag'))
                <div class="fail">
                    {{session()->get('errorAddToBag')}}
                </div>
            @elseif(session()->has('successAddToFavorite'))
                <div class="success">
                    {{session()->get('successAddToFavorite')}}
                </div>
            @elseif(session()->has('eerrorAddToFavorite'))
            <div class="fail">
                {{session()->get('eerrorAddToFavorite')}}
            </div>
            @elseif(session()->has('errorAddToFavorite'))
                <div class="fail">
                    {{session()->get('errorAddToFavorite')}}
                </div>
            @elseif(session()->has('successRemoveFromBag'))
            <div class="success">
                {{session()->get('successRemoveFromBag')}}
            </div>
            @elseif(session()->has('storeRequestSuccess'))
            <div class="success">
                {{session()->get('storeRequestSuccess')}}
            </div>
            @endif
        </div>

        @yield('content')
        {{-- end content --}}

        {{-- js --}}
        <script src="{{asset("js/web/header-footer.js")}}"></script>
    </body>
    </html>
