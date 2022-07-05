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

<div id="category">
    <h1>{{__('admin.infoAbout')}} {{$category->title}}</h1>
    <table class="table">
            <thead>
                <tr>
                    <th style="border:none;">{{__('admin.Key')}}</th>
                    <td style="border:none;">{{__('admin.Value')}}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{__('admin.ID')}}</th>
                    <td>{{$category->id}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.CategoryImage')}}</th>
                    <td><img class="headerImg" src="{{asset('storage/'.$category->image)}}" alt="{{$category->title}}" width="30px"></td>
                </tr>
                <tr>
                    <th class="thstart">{{__('admin.CategoryArabicName')}}</th>
                    <td>{{$category->getTranslation('title','ar')}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.CategoryEnglishName')}}</th>
                    <td>{{$category->getTranslation('title','en')}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.Route')}}</th>
                    <td>{{$category->route}}</td>
                </tr>
            </tbody>
    </table>

@endsection

