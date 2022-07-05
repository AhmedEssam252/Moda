@extends('admin.layouts.master')

@section('title'){{__('admin.Edit')}} {{__('admin.request')}} {{$customerRequest->id}} @endsection

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

@if(session()->has('error2'))
<div class="fail">
    {{session()->get('error2')}}
</div>
@endif

<div id="category">
<h1 class="title2">{{__('admin.Edit')}} {{__('lang.request')}} {{$customerRequest->id}}</h1>

<form class="form" method="POST" action="/admin/requests/{{$customerRequest->id}}/update" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <div class="label">
            <label for="status">{{__('admin.Status')}}</label>
            <select name="status" id="status" required>
                <option value="{{__('admin.Status')}}" selected disabled>{{__('admin.Status')}}</option>
                <option value="Processing" >{{__('lang.Processing')}}</option>
                <option value="Shipped" >{{__('lang.Shipped')}}</option>
                <option value="Delivered" >{{__('lang.Delivered')}}</option>
                <option value="Completed" >{{__('lang.Completed')}}</option>
                <option value="Canceled" >{{__('lang.Canceled')}}</option>

            </select>
        </div>
    </div>
    <input type="submit" class="submit" value="{{__('admin.Update')}}">
</form>
</div>
@endsection
