@extends('admin.layouts.master')

@section('title'){{ __('admin.Create') }} {{ __('admin.Users') }} @endsection

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
    @else
        <div class="fail">
            {{session()->get('storeError')}}
        </div>
    @endif
</div>
<form class="form" action="{{route('StoreUser')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>{{ __('admin.Create') }} {{ __('admin.User') }} </h1>
    <div class="form-group">
        <div class="label">
            <label for="FirstName">{{__('admin.FirstName')}}</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="{{__('admin.FirstName')}}" required>
        </div>
        @error('FirstName')
        <span class="error">{{ $message }}</span>
        @enderror
        <div class="label">
            <label for="LastName">{{__('admin.LastName')}}</label>
            <input type="text" id="LastName" name="LastName" placeholder="{{__('admin.LastName')}}" required>
        </div>
        @error('LastName')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <div class="label">
            <label for="Email">{{__('admin.Email')}}</label>
            <input type="Email" class="form-control" id="Email" name="Email" placeholder="{{__('admin.Email')}}" required>
            @error('Email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="label">
            <label for="Password">{{__('admin.Password')}}</label>
            <input type="Password" id="Password" name="Password" placeholder="{{__('admin.Password')}}" required>
            @error('Password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group">
        <div class="label">
            <label for="upload_image[]">{{__('admin.profilephoto')}}</label>
            <input type="file" id="upload_image" accept="image/*"  name="upload_image[]"  multiple required>
            @error('upload_image')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div> --}}
    <input type="submit" class="submit" value="{{ __('admin.Create') }}">
</form>

@endsection

