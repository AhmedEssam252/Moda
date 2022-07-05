@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.SubCategory')}}@endsection

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

<div id="SubCategory">
    <h1>{{__('admin.trash')}} {{__('admin.SubCategories')}}</h1>
    <form method="get" action="#" class="searchBar" >
        <h2>{{__('admin.searchAbout')}} {{__('admin.SubCategory')}}</h2>
        <div class="search">
            <input type="text" name="search" id="search" list="SubCategories" value="{{request('search')}}">
            <datalist id="SubCategories">
                @foreach($subcategories as $subcategory)
                    <option value={{$subcategory->title}}>
                @endforeach
              </datalist>
            <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></button>
        </div>
           <a href={{route('indexSubCategory')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"></a>
     </form>
     <form method="get" action="#" class="filterBar" >
        <div class="filter">
           <select name="category" id="categoryFilter" onchange="this.form.submit()">
                <option value={{__('admin.Category')}} selected disabled>{{__('admin.Category')}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->route}}">{{$category->title}}</option>
                @endforeach
           </select>
        </div>
     </form>
    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.SubCategoryImage')}}</th>
                <th class="thstart">{{__('admin.SubCategoryArabicName')}}</th>
                <th>{{__('admin.SubCategoryEnglishName')}}</th>
                <th>{{__('admin.Route')}}</th>
                <th>{{__('admin.Category')}}</th>
                <th>{{__('admin.restore')}}</th>
                <th class="thend">{{__('admin.forceDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($subcategories->count() == 0)
            <tr>
                <td colspan="8">{{ __('admin.noSubCategory') }}</td>
            </tr>
            @else
            @foreach($subcategories as $subcategory)
            <tr>
                <td>{{$subcategory->id}}</td>
                <td>
                    @if($subcategory->image)
                        <img class="headerImg" src="{{asset('storage/'.$subcategory->image)}}" alt="{{$subcategory->title}}" width="30px">
                    @endif
                </td>
                <td>{{$subcategory->getTranslation('title','ar')}}</td>
                <td>{{$subcategory->getTranslation('title','en')}}</td>
                <td>{{$subcategory->route}}</td>
                {{-- check if have category first before give it title--}}
                @if ($subcategory->category == null)
                <td>No Category</td>
                @else
                <td>{{$subcategory->category->title}}</td>
                @endif
                <td>
                    <a  href="/admin/subCategories/{{$subcategory->route}}/restore"><img src="{{asset('img/dashboard/reset-svgrepo-com.svg')}}" alt="restore" width="30px" height="30px"></a>
                </td>
                <td>
                    <div  onclick="myFunction2(this)">
                        <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                            <div class="warning">
                                <div class="title">
                                    <p class="warningTitle">{{__('admin.Warning')}}</p>
                                </div>
                                <div class="content">
                                    <p class="alartMessage">{{__('admin.AreYouSureYouWantToDeleteThisSubCategory')}}</p>
                                    <div>
                                    <form method="post" action="{{route('ForceDeleteSubcategory',$subcategory->route)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('SoftDeleteSubCategory')}} class="cancel">{{__('admin.Cancel')}}</a>
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
    {{$subcategories->links('pagination::bootstrap-5')}}

@endsection
