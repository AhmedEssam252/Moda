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
    @if(session()->has('restoresuccess'))
        <div class="success">
            {{session()->get('restoresuccess')}}
        </div>
    @elseif(session()->has('forceDeleteSuccess'))
        <div class="success">
            {{session()->get('forceDeleteSuccess')}}
        </div>
    @elseif(session()->has('error2'))
    <div class="fail">
        {{session()->get('error2')}}
    </div>
    @endif
</div>

<div id="category">
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
    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.CategoryImage')}}</th>
                <th class="thstart">{{__('admin.CategoryArabicName')}}</th>
                <th>{{__('admin.CategoryEnglishName')}}</th>
                <th>{{__('admin.Route')}}</th>
                <th>{{__('admin.restore')}}</th>
                <th class="thend">{{__('admin.forceDelete')}}</th>
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
                    @if($category->image)
                        <img class="headerImg" src="{{asset('storage/'.$category->image)}}" alt="{{$category->title}}" width="30px">
                    @endif
                </td>
                <td>{{$category->getTranslation('title','ar')}}</td>
                <td>{{$category->getTranslation('title','en')}}</td>
                <td>{{$category->route}}</td>
                <td class="infoCategory">
                    <a  href="/admin/categories/{{$category->route}}/restore"><img src="{{asset('img/dashboard/reset-svgrepo-com.svg')}}" alt="restore" width="30px" height="30px"></a>
                </td>
                <td>

                    <div  onclick="myFunction2(this)">
                        <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                            <div class="warning">
                                <div class="title">
                                    <p class="warningTitle">{{__('admin.Warning')}}</p>
                                </div>
                                <div class="content">
                                    <p class="alartMessage">{{__('admin.AreYouSureYouWantToDeleteThisCategory')}}</p>
                                    <div>
                                    <form method="post" action="{{route('ForceDeleteCategory',$category->route)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('SoftDeleteCategory')}} class="cancel">{{__('admin.Cancel')}}</a>
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
