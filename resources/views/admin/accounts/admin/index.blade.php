@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Admin')}}@endsection

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
    <h1>{{__('admin.Show')}} {{__('admin.Admins')}}</h1>
    <form method="get" action="#" class="searchBar" >
        <h2>{{__('admin.searchAbout')}} {{__('admin.Admin')}}</h2>
        <div class="search">
            <input type="text" name="search" id="search" list="Admin" value={{request('search')}} >
            <datalist id="Admin">
                @foreach($admins as $admin)
                    <option value={{$admin->first_name . ' ' . $admin->last_name}}>
                @endforeach
              </datalist>
            <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></button>
        </div>
           <a href={{route('indexCategory')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></a>
     </form>
    <div class="actions">
        <a class="createCategory" href={{route('CreateAdmin')}}><img src="{{asset('img/dashboard/drawer-add-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"><p>{{__('admin.Create')}} {{__('admin.Admin')}}</p></a>
        <a class="createCategory"href={{route('downloadcsvAdmin')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as CSV</a>
        <a class="createCategory" href={{route('downloadxlsxAdmin')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as XLSX</a>
        <a class="createCategory" href={{route('SoftDeleteAdmin')}}><img src="{{asset('img/dashboard/green-recycle-trash-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">{{__('admin.trash')}}</a>
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
                <th>{{__('admin.Info')}}</th>
                <th>{{__('admin.Edit')}}</th>
                <th class="thend">{{__('admin.softDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($admins->count() == 0)
            <tr>
                <td colspan="8">{{ __('admin.noAdmin') }}</td>
            </tr>
            @else
            @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                {{-- <td>
                    <img class="headerImg" src="{{asset('storage/'.$admin->image)}}" alt="{{$admin->first_name}}" width="30px">
                </td> --}}
                <td>{{$admin->first_name}}</td>
                <td>{{$admin->last_name}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    @if($admin->is_online())
                        Online
                    @else
                        Offline
                    @endif
                </td>
                <td>
                    {{ Carbon\Carbon::parse($admin->last_seen)->diffForHumans() }}
                </td>
                <td class="infoCategory">
                    <a  href="/admin/account/admins/{{$admin->id}}/info"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                </td>
                <td class="editCategory">
                    <a  href="/admin/account/admins/{{$admin->id}}/edit"><img src="{{asset('img/dashboard/edit-svgrepo-com.svg')}}" alt="edit" width="30px" height="30px"></a>
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
                                    <form method="post" action="{{route('DeleteAdmin',$admin->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('indexAdmin')}} class="cancel">{{__('admin.Cancel')}}</a>
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
    {{$admins->links('pagination::bootstrap-5')}}

@endsection
