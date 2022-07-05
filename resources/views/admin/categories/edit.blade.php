@extends('admin.layouts.master')

@section('title'){{__('admin.Edit')}} {{__('admin.Category')}} {{$category->title}} @endsection

@section('styles')
@if(app()->getLocale() == 'ar')
<style>
.message {
    left: 50px;
}
</style>
@else
<style>
.message {
    right: 50px;
}
</style>
@endif
@endsection

@section('content')
<div class="message">
    @if(session()->has('error2'))
    <div class="fail">
        {{session()->get('error2')}}
    </div>
    @elseif(session()->has('storeError'))
    <div class="fail">
        {{session()->get('storeError')}}
    </div>
    @endif
</div>
<div id="category">
<h1>{{__('admin.Edit')}} {{__('admin.Category')}} {{$category->title}}</h1>

<form class="form" method="POST" action="/admin/categories/{{$category->route}}/update" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <div class="label">
            <label for="ArabicName">{{__('admin.CategoryArabicName')}}</label>
            <input type="text" id="ArabicName" name="ArabicName" placeholder="{{__('admin.CategoryArabicName')}}" value={{$category->getTranslation('title','ar')}}>
            @error('ArabicName')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="EnglishName">{{__('admin.CategoryEnglishName')}}</label>
            <input type="text" id="EnglishName" name="EnglishName" placeholder="{{__('admin.CategoryEnglishName')}}" value={{$category->getTranslation('title','en')}}>
            @error('EnglishName')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="route">{{__('admin.Route')}}</label>
            <input type="text" id="route" name="route" placeholder="{{__('admin.Route')}}" value={{$category->route}}>
            @error('route')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="upload_image">{{__('admin.UploadImage')}}</label>
            <input type="file" class="form-control" accept="image/*" id="upload_image" name="upload_image[]" multiple>
            @error('upload_image.*')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <input type="submit" class="submit" value="{{__('admin.Update')}}">
</form>
</div>
@endsection
