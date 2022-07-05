@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Categories')}}@endsection

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
    <h1>{{__('admin.Show')}} {{__('admin.Categories')}}</h1>
    <form method="get" action="#" class="searchBar" >
        <h2>{{__('admin.searchAbout')}} {{__('admin.Category')}}</h2>
        <div class="search">
            <input type="text" name="search" id="search" list="categories" value={{request('search')}} >
            <datalist id="categories">
                @foreach($categories as $category)
                    <option value={{$category->title}}>
                @endforeach
              </datalist>
            <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></button>
        </div>
           <a href={{route('indexCategory')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></a>
     </form>
    <div class="actions">
        <a class="createCategory" href={{route('CreateCategory')}}><img src="{{asset('img/dashboard/drawer-add-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"><p>{{__('admin.Create')}} {{__('admin.Category')}}</p></a>
        <a class="createCategory"href={{route('downloadcsvCategory')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as CSV</a>
        <a class="createCategory" href={{route('downloadxlsxCategory')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as XLSX</a>
        <a class="createCategory" href={{route('SoftDeleteCategory')}}><img src="{{asset('img/dashboard/green-recycle-trash-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">{{__('admin.trash')}}</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.CategoryImage')}}</th>
                <th class="thstart">{{__('admin.CategoryArabicName')}}</th>
                <th>{{__('admin.CategoryEnglishName')}}</th>
                <th>{{__('admin.Route')}}</th>
                <th>{{__('admin.Info')}}</th>
                <th>{{__('admin.Edit')}}</th>
                <th class="thend">{{__('admin.softDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count() == 0)
            <tr>
                <td colspan="8">{{ __('admin.noCategory') }}</td>
            </tr>
            @else
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>
                    <img class="headerImg" src="{{asset('storage/'.$category->image)}}" alt="{{$category->title}}" width="30px">
                </td>
                <td>{{$category->getTranslation('title','ar')}}</td>
                <td>{{$category->getTranslation('title','en')}}</td>
                <td>{{$category->route}}</td>
                <td class="infoCategory">
                    <a  href="/admin/categories/{{$category->route}}/info"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                </td>
                <td class="editCategory">
                    <a  href="/admin/categories/{{$category->route}}/edit"><img src="{{asset('img/dashboard/edit-svgrepo-com.svg')}}" alt="edit" width="30px" height="30px"></a>
                </td>
                <td>
                    <div  onclick="myFunction2(this)">
                        <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                            <div class="warning">
                                <div class="title">
                                    <p class="warningTitle">{{__('admin.Warning')}}</p>
                                </div>
                                <div class="content">
                                    <p class="alartMessage">{{__('admin.AreYouSureYouWantToputThisCategoryInTrash')}}</p>
                                    <div>
                                    <form method="post" action="{{route('DeleteCategory',$category->route)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('indexCategory')}} class="cancel">{{__('admin.Cancel')}}</a>
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
    {{$categories->links('pagination::bootstrap-5')}}

@endsection
