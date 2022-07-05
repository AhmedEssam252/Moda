@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Users')}} {{$user->first_name . ' ' . $user->last_name}}@endsection

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
    <h1>{{__('admin.infoAbout')}} {{$user->title}}</h1>
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
                    <td>{{$user->id}}</td>
                </tr>
                {{-- <tr>
                    <th>{{__('admin.profilephoto')}}</th>
                    <td><img class="headerImg" src="{{asset('storage/'.$admin->image)}}" alt="{{$admin->first_name}}" width="30px"></td>
                </tr> --}}
                <tr>
                    <th class="thstart">{{__('admin.FirstName')}}</th>
                    <td>{{$user->first_name}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.LastName')}}</th>
                    <td>{{$user->last_name}}</td>

                </tr>
                <tr>
                    <th>{{__('admin.Email')}}</th>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <th>{{__('admin.Status')}}</th>
                    <td>
                        @if($user->is_online())
                            Online
                        @else
                            Offline
                        @endif
                    </td>                </tr>
                <tr>
                    <th>{{__('admin.Last_seen')}}</th>
                    <td>
                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                    </td>
                </tr>
                <tr>
                    <th>{{__('admin.ban_user')}}</th>
                    <td>
                        @if($user->ban == 1)
                        {{__('admin.yes')}}
                        @else
                        {{__('admin.no')}}
                        @endif
                    </td>
                </tr>
            </tbody>
    </table>

@endsection

