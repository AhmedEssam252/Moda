@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Admin')}} {{$admin->first_name . ' ' . $admin->last_name}}@endsection

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
    @endif
</div>

<div id="category">
    <h1>{{__('admin.infoAbout')}} {{$admin->title}}</h1>
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
                    <td>{{$admin->id}}</td>
                </tr>
                {{-- <tr>
                    <th>{{__('admin.profilephoto')}}</th>
                    <td><img class="headerImg" src="{{asset('storage/'.$admin->image)}}" alt="{{$admin->first_name}}" width="30px"></td>
                </tr> --}}
                <tr>
                    <th class="thstart">{{__('admin.FirstName')}}</th>
                    <td>{{$admin->first_name}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.LastName')}}</th>
                    <td>{{$admin->last_name}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.Email')}}</th>
                    <td>{{$admin->email}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.Status')}}</th>
                    <td>
                        @if($admin->is_online())
                            Online
                        @else
                            Offline
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{__('admin.Last_seen')}}</th>
                    <td>
                        {{ Carbon\Carbon::parse($admin->last_seen)->diffForHumans() }}
                    </td>
                </tr>


            </tbody>
    </table>

@endsection

