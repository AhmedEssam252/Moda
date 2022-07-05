@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Product')}}@endsection

@section('styles')
<style>
    .table{
        align-self: start;
    }
    #Product h1{
        align-self: end;
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
    #Product{
        height:100vh;
        padding-top: 0 !important;
    }
</style>
@endif
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

<div id="SubCategory">
    <h1>{{__('admin.infoAbout')}} {{$product->title}}</h1>
    <table class="table" width="100%">
            <thead>
                <tr>
                    <th style="border:none;">{{__('admin.Key')}}</th>
                    <td style="border:none;">{{__('admin.Value')}}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th width="30%">{{__('admin.ID')}}</th>
                    <td width="70%">{{$product->id}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.ProductImage')}}</th>
                    <td><img class="headerImg" src="{{asset('storage/'.$product->image)}}" alt="{{$product->title}}" width="100px"></td>
                </tr>
                <tr>
                    <th class="thstart">{{__('admin.ProductArabicName')}}</th>
                    <td>{{$product->getTranslation('title','ar')}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.ProductEnglishName')}}</th>
                    <td>{{$product->getTranslation('title','en')}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.Route')}}</th>
                    <td>{{$product->route}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.Category')}}</th>
                    <td>{{$product->category->title}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.SubCategory')}}</th>
                    @if ($product->subcategory == null)
                    <td>No SubCategory</td>
                    @else
                    <td>{{$product->subcategory->title}}</td>
                    @endif
                </tr>
                <tr>
                    <th class="thstart">{{__('lang.Price')}}</th>
                    <td>{{$product->price}}</td>

                </tr>
                <tr>
                    <th>{{__('lang.Size')}}</th>
                    <td>{{implode(',',$product->size)}}</td>

                </tr>
                <tr>
                    <th class="thstart">{{__('admin.ArabicDescription')}}</th>
                    <td>{{$product->getTranslation('description','ar')}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.EnglishDescription')}}</th>
                    <td>{{$product->getTranslation('description','en')}}</td>

                </tr>
                <tr>
                    <th class="thstart">{{__('admin.ArabicRecovery')}}</th>
                    <td>{{$product->getTranslation('recovery','ar')}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.EnglishRecovery')}}</th>
                    <td>{{$product->getTranslation('recovery','en')}}</td>

                </tr>
            </tbody>
    </table>

@endsection

