@extends('admin.layouts.master')

@section('title'){{ __('admin.Create') }} {{ __('admin.Category') }} @endsection

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
    @if(session()->has('storeSuccess'))
        <div class="success">
            {{session()->get('storeSuccess')}}
        </div>
    @elseif(session()->has('storeError'))
    <div class="fail">
        {{session()->get('storeError')}}
    </div>
    @elseif(session()->has('error2'))
        <div class="fail">
            {{session()->get('error2')}}
        </div>
    @endif
</div>
<form class="form" action="{{route('StoreCategory')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>{{ __('admin.Create') }} {{ __('admin.Category') }} </h1>
    <div class="form-group">
        <div class="label">
            <label for="ArabicName">{{__('admin.CategoryArabicName')}}</label>
            <input type="text" class="form-control" id="ArabicName" name="ArabicName" placeholder="{{__('admin.CategoryArabicName')}}" required>
        </div>
        @error('ArabicName')
        <span class="error">{{ $message }}</span>
        @enderror
        <div class="label">
            <label for="EnglishName">{{__('admin.CategoryEnglishName')}}</label>
            <input type="text" class="form-control" id="EnglishName" name="EnglishName" placeholder="{{__('admin.CategoryEnglishName')}}" required>
        </div>
        @error('EnglishName')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <div class="label">
            <label for="route">{{__('admin.Route')}}</label>
            <input type="text" class="form-control" id="route" name="route" placeholder="{{__('admin.Route')}}" required>
            @error('route')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="upload_image[]">{{__('admin.UploadImage')}}</label>
            <input type="file" id="upload_image" accept="image/*"  name="upload_image[]"  multiple required>
            @error('upload_image.*')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <input type="submit" class="submit" value="{{ __('admin.Create') }}">
</form>

@endsection

