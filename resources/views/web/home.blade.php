@extends('web.layouts.master')

@section('title') {{ __('lang.Home') }} @endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/web/home.css')}}">
@endsection

@section('content')
{{-- Home --}}
<section id="Home">
    <div class="mySlides fade">
        <div class="cover cover1">
            <div class="slider-content">
                <div class="offer offer1">
                    <img src={{asset(__('lang.saleImg'))}} alt="offer" width="150" height="150" class="offera1">
                    <img src="{{asset('img/Home/pexels-artem-beliaikin-1078958.jpg')}}" alt="clothes" width="180" height="271" class="cloth cloth1">
                    <h1>{{ __('lang.Sale') }}</h1>
                    <a href="/products">{{ __('lang.DiscoverMore') }}</a>
                </div>
                <div class="title title1">
                    <h1>{{ __('lang.ModaOffers') }}</h1>
                    <div class="line line1"></div>
                    <div class="line line2"></div>
                </div>
                <div class="offer offer2">
                    <img src={{asset(__('lang.saleImg'))}} alt="offer" width="150" height="150" class="offera2">
                    <img src="{{asset('img/Home/pexels-skylar-kang-6046183.jpg')}}" alt="shoes" width="180" height="271" class="cloth cloth2">
                    <h1>{{ __('lang.Sale') }}</h1>
                    <a href="/products">{{ __('lang.DiscoverMore') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mySlides fade">
        <div class="cover cover3">
            <div class="slider-content">
                <div class="title title1">
                    <h1>{{ __('lang.TrandingClothes') }}</h1>
                    <div class="line line1"></div>
                    <div class="line line2"></div>
                </div>
                @if ($products3->count() == 0)
                <h1>{{__('lang.noProducts')}}</h1>
                @else
                @foreach ($products3 as $product)
                <div class="offer">
                    <img src="{{asset('storage/' . $product->image)}}" alt="accs" width="100%" height="100%" class="cloth">
                    <a href={{"products/$product->route"}}>{{ __('lang.Details') }}</a>
                </div>
                @endforEach
                @endif
            </div>
        </div>
    </div>
    <div class="mySlides fade">
        <div class="cover cover2">
            <div class="slider-content">

                @if ($products4->count() == 0)
                <h1>{{__('lang.noProducts')}}</h1>
                @else
                @foreach ($products4 as $product)
                <div class="offer">
                    <img src="{{asset('storage/' . $product->image)}}" alt="accs" width="100%" height="100%" class="cloth">
                    <a href={{"products/$product->route"}}>{{ __('lang.Details') }}</a>
                </div>
                @endforEach
                @endif
                <div class="title title1">
                    <h1>{{ __('lang.Accessories') }}</h1>
                    <div class="line line1"></div>
                    <div class="line line2"></div>
                </div>
            </div>
        </div>
    </div>
    <button class="prev" onclick="plusSlides(-1)">❯</button>
    <button class="next" onclick="plusSlides(1)">❮</button>
</div>

</section>
{{-- End Home --}}
{{-- categories --}}
<section id="categories">
    <h1>{{ __('lang.Category') }}</h1>
    <div class="slider-content">
        @foreach ($categories as $category)
            <div class="offer">
                <img src="{{asset('storage/' . $category->image)}}" alt="clothes" width="300" height="300" class="cloth cloth2">
                <h1>{{$category->title}}</h1>
                <a href={{'categories/' . $category->route}}>{{ __('lang.DiscoverMore') }}</a>
            </div>
        @endforeach
    </div>
</section>
{{-- End categories --}}

<script src="{{asset('js/web/home.js')}}"></script>

@endsection
