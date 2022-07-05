@extends('admin.layouts.master')

@section('title'){{ __('admin.Create') }} {{ __('admin.SubCategory') }} @endsection

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
    @elseif(session()->has('error2'))
        <div class="fail">
            {{session()->get('error2')}}
        </div>
    @elseif(session()->has('storeError'))
        <div class="fail">
            {{session()->get('storeError')}}
        </div>
    @endif
</div>
<form class="form" action="{{route('StoreSubCategory')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>{{ __('admin.Create') }} {{ __('admin.SubCategory') }} </h1>
    <div class="form-group">
        <div class="label">
            <label for="ArabicName">{{__('admin.SubCategoryArabicName')}}</label>
            <input type="text" class="form-control" id="ArabicName" name="ArabicName" placeholder="{{__('admin.SubCategoryArabicName')}}" required>
        </div>
        @error('ArabicName')
        <span class="error">{{ $message }}</span>
        @enderror
        <div class="label">
            <label for="EnglishName">{{__('admin.SubCategoryEnglishName')}}</label>
            <input type="text" class="form-control" id="EnglishName" name="EnglishName" placeholder="{{__('admin.SubCategoryEnglishName')}}" required>
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
            <input type="file" id="upload_image" accept="image/*"  name="upload_image[]"  required>
            @error('upload_image.*')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="categoryName">{{__('admin.Category')}}</label>
            <select name="categoryName" id="categoryName" required>
                <option value="{{__('admin.Category')}}" selected disabled>{{__('admin.Category')}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            @error('categoryName')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <input type="submit" class="submit" value="{{ __('admin.Create') }}">
</form>

@endsection

