@extends('admin.layouts.master')

@section('title'){{__('admin.Edit')}} {{__('admin.Admin')}} {{$admin->first_name . ' ' . $admin->last_name}} @endsection

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
<div id="category">

<form class="form" method="POST" action="/admin/account/admins/{{$admin->id}}/update" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <h1>{{ __('admin.Edit') }} {{ __('admin.Admin') }} </h1>
    <div class="form-group">
        <div class="label">
            <label for="FirstName">{{__('admin.FirstName')}}</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="{{__('admin.FirstName')}}" value="{{$admin->first_name}}" required>
        </div>
        @error('FirstName')
        <span class="error">{{ $message }}</span>
        @enderror
        <div class="label">
            <label for="LastName">{{__('admin.LastName')}}</label>
            <input type="text" id="LastName" name="LastName" placeholder="{{__('admin.LastName')}}" value="{{$admin->last_name}}" required>
        </div>
        @error('LastName')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <div class="label">
            <label for="Email">{{__('admin.Email')}}</label>
            <input type="Email" class="form-control" id="Email" name="Email" placeholder="{{__('admin.Email')}}" value="{{$admin->email}}" required>
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
    <input type="submit" class="submit" value="{{__('admin.Update')}}">
</form>
</div>
@endsection
