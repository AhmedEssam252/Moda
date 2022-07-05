@extends('web.layouts.master')

@section('title') {{ __('lang.CompleteYourPurchase') }} @endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/web/checkout.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/adminList/add.css')}}">
<style>
.searchBar {
    display: grid;
    width: 70%;
    margin: 50px auto;
    justify-self: center;
    position: relative;
    justify-items: center;
    }
    .table{
        margin: 40px auto !important;
    }
</style>
@if(app()->getLocale() == 'ar')
        <style>
            .search .submit {
                left: 5px;
            }
        </style>
        @endif
        @if(app()->getLocale() == 'en')
        <style>
            .search .submit {
                right: 5px;
            }
        </style>
        @endif
@endsection

@section('content')
<section id="Checkout">
    <h1>{{ __('lang.yourRequests') }}</h1>
</section>

<h1 style="text-align:center; margin:50px 0;">{{__('admin.Show')}} {{__('lang.yourRequests')}}</h1>
<form method="get" action="#" class="searchBar" >
    <h2 style="text-align:center;">{{__('admin.searchAbout')}} {{__('lang.request')}}</h2>
    <div class="search">
        <input type="text" name="search" id="search"  list="categories" value={{request('search')}} >
        <datalist id="categories">
            @foreach ($customerRequests as $customerRequest)
                    <option value={{$customerRequest->id}}>
            @endforeach
          </datalist>
        <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></button>
    </div>
       <a href={{route('CustomerRequests')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></a>
 </form>

@if ($customerRequests->count() == 0)
        <tr>
            <td colspan="8"><h1 style="text-align:center;">{{ __('lang.noRequests') }}</h1></td>
        </tr>
        @else
        @foreach ($customerRequests as $customerRequest)
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
                <tr>
                    <th>{{__('admin.Info')}}</th>
                    <td class="infoCategory">
                        <a href="/requests/{{$customerRequest->id}}"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach
        @endif
{{$customerRequests->links('pagination::bootstrap-5')}}

{{-- js --}}
<script src="{{asset('js/admin/dashboard.js')}}"></script>

@endsection
