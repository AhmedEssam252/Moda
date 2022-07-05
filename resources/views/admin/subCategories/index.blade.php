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

<div id="SubCategory">
    <h1>{{__('admin.Show')}} {{__('admin.SubCategories')}}</h1>
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
        {{-- <h2>{{__('admin.searchAbout')}} {{__('admin.SubCategory')}}</h2> --}}
        <div class="filter">
           <select name="category" id="categoryFilter" onchange="this.form.submit()">
                <option value={{__('admin.Category')}} selected disabled>{{__('admin.Category')}}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->route}}">{{$category->title}}</option>
                @endforeach
           </select>
        </div>
     </form>
    <div class="actions">
        <a class="createSubCategory" href={{route('CreateSubCategory')}}><img src="{{asset('img/dashboard/drawer-add-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px"><p>{{__('admin.Create')}} {{__('admin.SubCategory')}}</p></a>
        <a class="createSubCategory"href={{route('downloadcsvSubCategory')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as CSV</a>
        <a class="createSubCategory" href={{route('downloadxlsxSubCategory')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">Export as XLSX</a>
        <a class="createSubCategory" href={{route('SoftDeleteSubCategory')}}><img src="{{asset('img/dashboard/green-recycle-trash-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">{{__('admin.trash')}}</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.SubCategoryImage')}}</th>
                <th class="thstart">{{__('admin.SubCategoryArabicName')}}</th>
                <th>{{__('admin.SubCategoryEnglishName')}}</th>
                <th>{{__('admin.Route')}}</th>
                <th>{{__('admin.Category')}}</th>
                <th>{{__('admin.Info')}}</th>
                <th>{{__('admin.Edit')}}</th>
                <th class="thend">{{__('admin.softDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($subcategories->count() == 0)
            <tr>
                <td colspan="9">{{ __('admin.noSubCategory') }}</td>
            </tr>
            @else
            @foreach($subcategories as $subcategory)
            <tr>
                <td>{{$subcategory->id}}</td>
                <td>
                    <img class="headerImg" src="{{asset('storage/'.$subcategory->image)}}" alt="{{$subcategory->title}}" width="30px">
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
                <td class="infoSubCategory">
                    <a  href="/admin/subCategories/{{$subcategory->route}}/info"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                </td>
                <td class="editSubCategory">
                    <a  href="/admin/subCategories/{{$subcategory->route}}/edit"><img src="{{asset('img/dashboard/edit-svgrepo-com.svg')}}" alt="edit" width="30px" height="30px"></a>
                </td>
                <td>
                    <div  onclick="myFunction2(this)">
                        <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                            <div class="warning">
                                <div class="title">
                                    <p class="warningTitle">{{__('admin.Warning')}}</p>
                                </div>
                                <div class="content">
                                    <p class="alartMessage">{{__('admin.AreYouSureYouWantToputThisSubCategoryInTrash')}}</p>
                                    <div>
                                    <form method="post" action="{{route('DeleteSubcategory',$subcategory->route)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('indexSubCategory')}} class="cancel">{{__('admin.Cancel')}}</a>
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
