@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Requests')}}@endsection

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
    @elseif(session()->has('error2'))
    <div class="fail">
        {{session()->get('error2')}}
    </div>
    @endif
</div>

<div id="category">
    <h1 class="title2">{{__('admin.Show')}} {{__('lang.Requests')}}</h1>
    <form method="get" action="#" class="searchBar" >
        <h2>{{__('admin.searchAbout')}} {{__('lang.request')}}</h2>
        <div class="search">
            <input type="text" name="search" id="search" list="Requests" value={{request('search')}} >
            <datalist id="Requests">
                @foreach($customerRequests as $customerRequest)
                    <option value={{$customerRequest->id}}>
                @endforeach
              </datalist>
            <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></button>
        </div>
           <a href={{route('indexCategory')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></a>
     </form>
    <div class="actions">
        <a class="createCategory"href={{route('downloadcsvCategory')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as CSV</a>
        <a class="createCategory" href={{route('downloadxlsxCategory')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as XLSX</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('lang.ProductCount')}}</th>
                <th class="thstart">{{__('admin.Date')}}</th>
                <th>{{__('admin.Status')}}</th>
                <th>{{__('admin.Total')}}</th>
                <th>{{__('admin.Info')}}</th>
                <th>{{__('admin.Edit')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($customerRequests->count() == 0)
            <tr>
                <td colspan="8">{{ __('admin.noCategory') }}</td>
            </tr>
            @else
            @foreach($customerRequests as $customerRequest)
            <tr>
                <td>{{$customerRequest->id}}</td>
                <td>{{count($customerRequest->productsInfo)}}</td>
                <td>{{$customerRequest->created_at}}</td>
                <td>{{$customerRequest->status}}</td>
                <td>{{$customerRequest->total}}</td>
                <td class="infoCategory">
                    <a  href="/admin/requests/{{$customerRequest->id}}/info"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                </td>
                <td class="editCategory">
                    <a  href="/admin/requests/{{$customerRequest->id}}/edit"><img src="{{asset('img/dashboard/edit-svgrepo-com.svg')}}" alt="edit" width="30px" height="30px"></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{$customerRequests->links('pagination::bootstrap-5')}}

@endsection
