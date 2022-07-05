@extends('admin.layouts.master')

@section('title'){{ __('admin.Dashboard') }}@endsection

@section('styles')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link rel="stylesheet" href="{{asset('css/admin/dashboard.css')}}">
@endsection

@section('content')

<div id="dashboard">
    <div class="numbers">
        <div class="box-number">
            <div class="iconWithNumber">
            <img src="{{asset('img/dashboard/user2-svgrepo-com.svg')}}" alt="users" width="40px" height="40px">
            @php $user_total = "0" @endphp

            @foreach($users as $user)
            @php
            if($user->is_online())
                 $user_total++
            @endphp
            @endforeach
            <h1 class="number">{{$user_total}}</h1>
            </div>
            <h1 style="margin-top: 20px;">{{__('admin.TotalUsers')}}</h1>
        </div>
        <div class="box-number">
             <div class="iconWithNumber">
            <img src="{{asset('img/dashboard/users2-svgrepo-com.svg')}}" alt="users" width="40px" height="40px">
            @php $admin_total = "0" @endphp

            @foreach($admins as $admin)
            @php
            if($admin->is_online())
                 $admin_total++
            @endphp
            @endforeach
            <h1 class="number">{{$admin_total}}</h1>
            </div>
            <h1 style="margin-top:20px;">{{__('admin.TotalAdmins')}}</h1>
        </div>
        <div class="box-number">
            <div class="iconWithNumber">
           <img src="{{asset('img/dashboard/users2-svgrepo-com.svg')}}" alt="users" width="40px" height="40px">
           @php $admin_total = "0" @endphp

           @foreach($admins as $admin)
           @php
           if($admin->is_online())
                $admin_total++
           @endphp
           @endforeach
           <h1 class="number">{{$admin_total}}</h1>
           </div>
           <h1 style="margin-top:20px;">{{__('admin.TotalAdmins')}}</h1>
        </div>
    </div>
    <div class="services">
        <div id="notes">
            <div class="popup-box">
                <div class="popup">
                  <div class="content">
                    <header>
                      <p></p>
                      <i class="uil uil-times"></i>
                    </header>
                    <form action="#">
                      <div class="row title">
                        <label>Title</label>
                        <input type="text" spellcheck="false">
                      </div>
                      <div class="row description">
                        <label>Description</label>
                        <textarea spellcheck="false"></textarea>
                      </div>
                      <button></button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="wrapper2">
                <li class="add-box">
                  <div class="icon"><i class="uil uil-plus"></i></div>
                  <p>Add new note</p>
                </li>
              </div>
        </div>
        <div class="wrapper">
            <div class="task-input">
              <input type="text" placeholder="Add a new task">
            </div>
            <div class="controls">
              <div class="filters">
                <span class="active" id="all">All</span>
                <span id="pending">Pending</span>
                <span id="completed">Completed</span>
              </div>
              <button class="clear-btn">Clear All</button>
            </div>
            <ul class="task-box"></ul>
          </div>
    </div>

      <edit-photo class="editPhoto" style="width:640px;height:480px"></edit-photo>
</div>
<script src="https://edit.photo/widget.js" async></script>
<script src="{{asset('js/admin/dashborad2.js')}}"></script>
@endsection
