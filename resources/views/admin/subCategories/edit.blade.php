@extends('admin.layouts.master')

@section('title'){{__('admin.Edit')}} {{__('admin.SubCategory')}} {{$subcategory->title}} @endsection

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

<div id="SubCategory">
<h1>{{__('admin.Edit')}} {{__('admin.SubCategory')}} {{$subcategory->title}}</h1>

<form class="form" method="POST" action="/admin/subCategories/{{$subcategory->route}}/update" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <div class="label">
            <label for="ArabicName">{{__('admin.SubCategoryArabicName')}}</label>
            <input type="text" class="form-control" id="ArabicName" name="ArabicName" placeholder="{{__('admin.SubCategoryArabicName')}}" value={{$subcategory->getTranslation('title','ar')}}>
            @error('ArabicName')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="EnglishName">{{__('admin.SubCategoryEnglishName')}}</label>
            <input type="text" class="form-control" id="EnglishName" name="EnglishName" placeholder="{{__('admin.SubCategoryEnglishName')}}" value={{$subcategory->getTranslation('title','en')}}>
            @error('EnglishName')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="route">{{__('admin.Route')}}</label>
            <input type="text" class="form-control" id="route" name="route" placeholder="{{__('admin.Route')}}" value={{$subcategory->route}}>
            @error('route')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="upload_image[]">{{__('admin.UploadImage')}}</label>
            <input type="file" class="form-control" accept="image/*" id="upload_image" name="upload_image[]" multiple>
            @error('upload_image.*')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="categoryName">{{__('admin.Category')}}</label>
            <select name="categoryName" id="categoryName" required>
                <option value="{{$subcategory->category_id}}" selected>{{$subcategory->category->title}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="submit" class="submit" value="{{__('admin.Update')}}">
</form>
</div>
@endsection
