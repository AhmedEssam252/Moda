@extends('web.layouts.master')

@section('title') {{ __('lang.CompleteYourPurchase') }} @endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/web/checkout.css')}}">
@endsection

@section('content')
<section id="Checkout">
    <h1>{{ __('lang.CompleteYourPurchase') }}</h1>
</section>
<section id="Form">
    <form action="{{route('StoreCheckout')}}" method="post">
        @csrf
        <div class="part part1">
            <label for="Address">{{ __('lang.Address') }}
                <br>
                <input type="text" name="Address" id="Address">
            </label>
            <label for="Apartment_number">{{ __('lang.Apartment_Number') }}
                <br>
                <input type="number" name="Apartment_number" id="Apartment_number">
            </label>
        </div>

        <div class="part part2">
            <div class="wrapper">
                <div class="select-btn">
                <input type="text" name="Country" id="Country" value="{{__('lang.Country')}}">
                <div class="down"></div>
                </div>
                <div class="content">
                <div class="search">
                    <input spellcheck="false" type="text" placeholder="Search" class="searchCountry">
                </div>
                <ul class="options"></ul>
                </div>
            </div>
            <label for="City">{{ __('lang.City') }}
                <input type="text" name="City" id="City">
            </label>
            <label for="State">{{ __('lang.State') }}
                <input type="text" name="State" id="State">
            </label>
        </div>
        <label for="Postal_Code">{{ __('lang.Postal_Code') }}
            <br>
            <input type="number" name="Postal_Code" id="Postal_Code">
        </label>
        <div class="part part3">
            <h2>{{ __('lang.Payment_Methods') }}</h2>
            <label for="Cash_On_Delivery">
                <input type="checkbox" name="Cash_On_Delivery" id="Cash_On_Delivery" value="Cash On Delivery">
                {{ __('lang.Cash_On_Delivery') }}
            </label>
            <input type="submit" value="{{ __('lang.Buy_Products') }}">
        </div>
    </form>
</section>

{{-- js --}}
<script src="{{asset('js/web/checkout.js')}}"></script>
@endsection
