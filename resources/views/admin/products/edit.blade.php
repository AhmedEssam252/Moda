@extends('admin.layouts.master')

@section('title'){{__('admin.Edit')}} {{__('admin.Product')}} {{$product->title}} @endsection

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
@elseif(session()->has('NameError'))
<div class="fail">
    {{session()->get('NameError')}}
</div>
@elseif(session()->has('DescriptionError'))
<div class="fail">
    {{session()->get('DescriptionError')}}
</div>
@elseif(session()->has('RecoveryError'))
<div class="fail">
    {{session()->get('RecoveryError')}}
</div>
@elseif(session()->has('errorSize'))
<div class="fail">
    {{session()->get('errorSize')}}
</div>
@endif
</div>
<div id="Product">
<h1>{{__('admin.Edit')}} {{__('admin.Product')}} {{$product->title}}</h1>

<form class="form" method="POST" action="/admin/Products/{{$product->route}}/update" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <div class="label">
            <label for="ArabicName">{{__('admin.ProductArabicName')}}</label>
            <input type="text" id="ArabicName" name="ArabicName" placeholder="{{__('admin.ProductArabicName')}}" value="{{$product->getTranslation('title','ar')}}" required >
        </div>
        @error('ArabicName')
        <span class="error">{{ $message }}</span>
        @enderror
        <div class="label">
            <label for="EnglishName">{{__('admin.ProductEnglishName')}}</label>
            <input type="text" id="EnglishName" name="EnglishName" placeholder="{{__('admin.ProductEnglishName')}}" value="{{$product->getTranslation('title','en')}}" required>
        </div>
        @error('EnglishName')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <div class="label">
            <label for="route">{{__('admin.Route')}}</label>
            <input type="text" id="route" name="route" placeholder="{{__('admin.Route')}}" value="{{$product->route}}"   required>
            @error('route')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="upload_image[]">{{__('admin.UploadImage')}}</label>
            <input type="file" id="upload_image" accept="image/*"  name="upload_image[]"  multiple>
            @error('upload_image.*')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="price">{{__('lang.Price')}}</label>
            <input type="number" id="price" name="price" placeholder="{{__('lang.Price')}}" value="{{$product->price}}" required>
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="size">{{__('lang.Size')}}</label>
            <label><input type="checkbox" name="size[]" value="S"
                @if(in_array('S',$product->size))
                    checked
                @endif
                 >S</label>
            <label><input type="checkbox" name="size[]" value="M"
                @if(in_array('M',$product->size))
                checked
                @endif
                >M</label>
            <label><input type="checkbox" name="size[]" value="L"
                @if(in_array('L',$product->size))
                checked
                @endif
                >L</label>
            <label><input type="checkbox" name="size[]" value="XL"
                @if(in_array('XL',$product->size))
                checked
                @endif
                >XL</label>
            <label><input type="checkbox" name="size[]" value="XXL"
                @if(in_array('XXL',$product->size))
                checked
                @endif
                >XXL</label>
            @error('size.*')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="ArabicDescription">{{__('admin.ArabicDescription')}}</label>
            <textarea id="ArabicDescription" name="ArabicDescription" placeholder="{{__('admin.ArabicDescription')}}" required >{{$product->getTranslation('description','ar')}}</textarea>
            @error('ArabicDescription')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="EnglishDescription">{{__('admin.EnglishDescription')}}</label>
            <textarea id="EnglishDescription" name="EnglishDescription" placeholder="{{__('admin.EnglishDescription')}}" required>{{$product->getTranslation('description','en')}}</textarea>
            @error('EnglishDescription')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="ArabicRecovery">{{__('admin.ArabicRecovery')}}</label>
            <textarea id="ArabicRecovery" name="ArabicRecovery" placeholder="{{__('admin.ArabicRecovery')}}">{{$product->getTranslation('recovery','ar')}}</textarea>
            @error('ArabicRecovery')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="EnglishRecovery">{{__('admin.EnglishRecovery')}}</label>
            <textarea id="EnglishRecovery" name="EnglishRecovery" placeholder="{{__('admin.EnglishRecovery')}}">{{$product->getTranslation('recovery','en')}}</textarea>
            @error('EnglishRecovery')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="categoryName">{{__('admin.Category')}}</label>
            <select name="categoryName" id="categoryName" required>
                <option value="{{$product->category_id}}" selected>{{$product->category->title}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="label">
            <label for="SubCategoryName">{{__('admin.SubCategory')}}</label>
            <select name="SubCategoryName" id="SubCategoryName">
                <option value="{{$product->subcategory_id}}" selected>
                    @if($product->subcategory_id == null)
                    {{__('admin.nosubCategory')}}
                    @else
                    {{$product->subcategory->title}}
                    @endif
                </option>
                <option value="">{{__('admin.nosubCategory')}}</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="submit" class="submit" value="{{ __('admin.Update') }}">
</form>
</div>
@endsection
