@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Users')}}@endsection

@section('styles')
@if(app()->getLocale() == 'ar')
<style>
    .thstart{
        border-radius: 0 10px 0 0;
    }
    .thend{
        border-radius: 10px 0 0 0;
    }
    .message {
        left: 50px;
    }
    .search .submit{
        left: 5px;
    }
</style>
@else
<style>
    .thstart{
        border-radius: 10px 0 0 0;
    }
    .thend{
        border-radius: 0 10px 0 0;
    }
    .message {
        right: 50px;
    }
    .search .submit{
        right: 5px;
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
    <h1>{{__('admin.Show')}} {{__('admin.Users')}}</h1>
    <form method="get" action="#" class="searchBar" >
        <h2>{{__('admin.searchAbout')}} {{__('admin.User')}}</h2>
        <div class="search">
            <input type="text" name="search" id="search" list="users" value={{request('search')}} >
            <datalist id="users">
                @foreach($users as $user)
                    <option value={{$user->first_name . ' ' . $user->last_name}}>
                @endforeach
              </datalist>
            <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></button>
        </div>
           <a href={{route('indexCategory')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></a>
     </form>
    <div class="actions">
        <a class="createCategory" href={{route('CreateUser')}}><img src="{{asset('img/dashboard/drawer-add-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"><p>{{__('admin.Create')}} {{__('admin.Admin')}}</p></a>
        <a class="createCategory"href={{route('downloadcsvUser')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as CSV</a>
        <a class="createCategory" href={{route('downloadxlsxUser')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as XLSX</a>
        <a class="createCategory" href={{route('SoftDeleteUser')}}><img src="{{asset('img/dashboard/green-recycle-trash-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">{{__('admin.trash')}}</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                {{-- <th>{{__('admin.profilephoto')}}</th> --}}
                <th>{{__('admin.FirstName')}}</th>
                <th class="thstart">{{__('admin.LastName')}}</th>
                <th>{{__('admin.Email')}}</th>
                <th>{{__('admin.Status')}}</th>
                <th>{{__('admin.Last_seen')}}</th>
                <th>{{__('admin.ban_user')}}</th>
                <th>{{__('admin.Info')}}</th>
                <th>{{__('admin.Edit')}}</th>
                <th class="thend">{{__('admin.softDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count() == 0)
            <tr>
                <td colspan="9">{{ __('admin.noUser') }}</td>
            </tr>
            @else
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                {{-- <td>
                    <img class="headerImg" src="{{asset('storage/'.$admin->image)}}" alt="{{$admin->first_name}}" width="30px">
                </td> --}}
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->is_online())
                        Online
                    @else
                        Offline
                    @endif
                </td>
                <td>
                    {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                </td>
                <td>
                    @if($user->ban == 1)
                    {{__('admin.yes')}}
                    @else
                    {{__('admin.no')}}
                    @endif
                </td>
                <td class="infoCategory">
                    <a  href="/admin/account/users/{{$user->id}}/info"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                </td>
                <td class="editCategory">
                    <a  href="/admin/account/users/{{$user->id}}/edit"><img src="{{asset('img/dashboard/edit-svgrepo-com.svg')}}" alt="edit" width="30px" height="30px"></a>
                </td>
                <td>
                    <div  onclick="myFunction2(this)">
                        <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                            <div class="warning">
                                <div class="title">
                                    <p class="warningTitle">{{__('admin.Warning')}}</p>
                                </div>
                                <div class="content">
                                    <p class="alartMessage">{{__('admin.AreYouSureYouWantToputThisAdminInTrash')}}</p>
                                    <div>
                                    <form method="post" action="{{route('DeleteUser',$user->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('indexUser')}} class="cancel">{{__('admin.Cancel')}}</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{$users->links('pagination::bootstrap-5')}}

@endsection
