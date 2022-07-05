@php
use App\Models\Product;
@endphp

@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Categories')}}@endsection

@section('styles')
<style>
    .table{
        align-self: start;
    }
    #category h1{
        align-self: end;
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
@if(app()->getLocale() == 'ar')
<style>
    .message {
        left: 50px;
    }
    .table tr, .table tr th, .table tr td{
        border-top:1px solid rgb(207, 207, 207)
    }
</style>
@else
<style>
    .message {
        right: 50px;
    }
    .table tr, .table tr th, .table tr td{
        border-top:1px solid rgb(207, 207, 207)
    }
    #category{
        height:100vh;
        padding-top: 0 !important;
    }
</style>
@endif
<link rel="stylesheet" href="{{asset('css/web/shoppingBag.css')}}">
@endsection

@section('content')
<div class="message">
    @if(session()->has('updateSuccess'))
        <div class="success">
            {{session()->get('updateSuccess')}}
        </div>
    @elseif(session()->has('softDeleteSuccess'))
    <div class="success">
        {{session()->get('softDeleteSuccess')}}
    </div>
    @elseif(session()->has('updateError'))
        <div class="fail">
            {{session()->get('updateError')}}
        </div>
    @elseif(session()->has('error2'))
    <div class="fail">
        {{session()->get('error2')}}
    </div>
    @endif
</div>

<h1 class="title2">{{__('admin.Show')}} {{__('admin.Info')}}</h1>
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
                @foreach ($customerRequest->productsInfo as $detail)
                <tr>
                    <th class="thstart">{{__('admin.FirstName')}}</th>
                    <td>{{$detail->first_name}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.LastName')}}</th>
                    <td>{{$detail->last_name}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.Email')}}</th>
                    <td>{{$detail->email}}</td>
                </tr>
                @endforeach
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
                </div>
                <div class="productInfo">
                    @php
                    @endphp
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

@endsection

