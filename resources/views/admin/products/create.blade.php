@extends('admin.layouts.master')

@section('title'){{ __('admin.Create') }} {{ __('admin.Product') }} @endsection

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
    @elseif(session()->has('errorSize'))
        <div class="fail">
            {{session()->get('errorSize')}}
        </div>
    @endif
</div>
<form class="form" action="{{route('StoreProduct')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>{{ __('admin.Create') }} {{ __('admin.Product') }} </h1>
    <div class="form-group">
        <div class="label">
            <label for="ArabicName">{{__('admin.ProductArabicName')}}</label>
            <input type="text" id="ArabicName" name="ArabicName" placeholder="{{__('admin.ProductArabicName')}}" required>
        </div>
        @error('ArabicName')
        <span class="error">{{ $message }}</span>
        @enderror
        <div class="label">
            <label for="EnglishName">{{__('admin.ProductEnglishName')}}</label>
            <input type="text" id="EnglishName" name="EnglishName" placeholder="{{__('admin.ProductEnglishName')}}" required>
        </div>
        @error('EnglishName')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <div class="label">
            <label for="route">{{__('admin.Route')}}</label>
            <input type="text" id="route" name="route" placeholder="{{__('admin.Route')}}" required>
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
    <div class="form-group">
        <div class="label">
            <label for="price">{{__('lang.Price')}}</label>
            <input type="number" id="price" name="price" placeholder="{{__('lang.Price')}}" required>
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="size">{{__('lang.Size')}}</label>
            <label><input type="checkbox" name="size[]" value="S" >S</label>
            <label><input type="checkbox" name="size[]" value="M" >M</label>
            <label><input type="checkbox" name="size[]" value="L" >L</label>
            <label><input type="checkbox" name="size[]" value="XL" >XL</label>
            <label><input type="checkbox" name="size[]" value="XXL" >XXL</label>
            @error('size.*')
            <span class="error">{{ $message }}</span>
        @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="ArabicDescription">{{__('admin.ArabicDescription')}}</label>
            <textarea id="ArabicDescription" name="ArabicDescription" placeholder="{{__('admin.ArabicDescription')}}" required></textarea>
            @error('ArabicDescription')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="EnglishDescription">{{__('admin.EnglishDescription')}}</label>
            <textarea id="EnglishDescription" name="EnglishDescription" placeholder="{{__('admin.EnglishDescription')}}" required></textarea>
            @error('EnglishDescription')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="ArabicRecovery">{{__('admin.ArabicRecovery')}}</label>
            <textarea id="ArabicRecovery" name="ArabicRecovery" placeholder="{{__('admin.ArabicRecovery')}}"></textarea>
            @error('ArabicRecovery')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="EnglishRecovery">{{__('admin.EnglishRecovery')}}</label>
            <textarea id="EnglishRecovery" name="EnglishRecovery" placeholder="{{__('admin.EnglishRecovery')}}"></textarea>
            @error('EnglishRecovery')
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
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="SubCategoryName">{{__('admin.SubCategory')}}</label>
            <select name="SubCategoryName" id="SubCategoryName" required>
                <option value="{{__('admin.SubCategory')}}" selected disabled>{{__('admin.SubCategory')}}</option>
                <option value="">{{__('admin.nosubCategory')}}</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="submit" class="submit" value="{{ __('admin.Create') }}">
</form>

@endsection

