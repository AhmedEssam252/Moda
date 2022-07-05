@extends('admin.layouts.master')

@section('title'){{__('admin.Show')}} {{__('admin.Product')}}@endsection

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
    <h1>{{__('admin.trash')}} {{__('admin.Products')}}</h1>
    <form method="get" action="#" class="searchBar" >
        <h2>{{__('admin.searchAbout')}} {{__('admin.Product')}}</h2>
        <div class="search">
            <input type="text" name="search" id="search" list="Products" value={{request('search')}} >
            <datalist id="Products">
                @foreach($products as $product)
                    <option value={{$product->title}}>
                @endforeach
            </datalist>
            <button type="submit" class="submit"><img src="{{asset('img/dashboard/search-svgrepo-com.svg')}}" alt="search" width="30px" height="30px"></button>
        </div>
           <a href={{route('indexProduct')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="reset" width="30px" height="30px"></a>
     </form>
     <div class="All-Filters">
     <form method="get" action="#" class="filterBar" >
        {{-- <h2>{{__('admin.searchAbout')}} {{__('admin.Product')}}</h2> --}}
        <select name="category" id="categoryFilter" onchange="this.form.submit()">
            <option value={{__('admin.Category')}} selected disabled>{{__('admin.Category')}}</option>
            @foreach ($categories as $category)
                <option value="{{$category->route}}">{{$category->title}}</option>
            @endforeach
       </select>
           {{-- <a href={{route('indexProduct')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="reset" width="30px" height="30px"></a> --}}
     </form>
     <form method="get" action="#" class="filterBar" >
        {{-- <h2>{{__('admin.searchAbout')}} {{__('admin.Product')}}</h2> --}}
        <select name="subcategory" id="subcategoryFilter" onchange="this.form.submit()">
            <option value={{__('admin.SubCategory')}} selected disabled>{{__('admin.SubCategory')}}</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{$subcategory->route}}">{{$subcategory->title}}</option>
            @endforeach
       </select>
           {{-- <a href={{route('indexProduct')}} class="reset"><img src="{{asset('img/dashboard/x-svgrepo-com.svg')}}" alt="reset" width="30px" height="30px"></a> --}}
     </form>
     </div>
    <table class="table">
        <thead>
            <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.ProductImage')}}</th>
                <th class="thstart">{{__('admin.ProductArabicName')}}</th>
                <th>{{__('admin.ProductEnglishName')}}</th>
                <th>{{__('admin.Route')}}</th>
                <th>{{__('admin.Category')}}</th>
                <th>{{__('admin.SubCategory')}}</th>
                <th>{{__('admin.restore')}}</th>
                <th class="thend">{{__('admin.forceDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->count() == 0)
            <tr>
                <td colspan="9">{{ __('admin.noSubCategory') }}</td>
            </tr>
            @else
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>
                    @if($product->image)
                        <img class="headerImg" src="{{asset('storage/'.$product->image)}}" alt="{{$product->title}}" width="30px">
                    @endif
                </td>
                <td>{{$product->getTranslation('title','ar')}}</td>
                <td>{{$product->getTranslation('title','en')}}</td>
                <td>{{$product->route}}</td>
                {{-- check if have category first before give it title--}}
                @if ($product->category == null)
                <td>No Category</td>
                @else
                <td>{{$product->category->title}}</td>
                @endif
                {{-- check if have subCategory first before give it title--}}
                @if ($product->subcategory == null)
                <td>No SubCategory</td>
                @else
                <td>{{$product->subcategory->title}}</td>
                @endif
                <td>
                    <a  href="/admin/Products/{{$product->route}}/restore"><img src="{{asset('img/dashboard/reset-svgrepo-com.svg')}}" alt="restore" width="30px" height="30px"></a>
                </td>
                <td>
                    <div  onclick="myFunction2(this)">
                        <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                            <div class="warning">
                                <div class="title">
                                    <p class="warningTitle">{{__('admin.Warning')}}</p>
                                </div>
                                <div class="content">
                                    <p class="alartMessage">{{__('admin.AreYouSureYouWantToDeleteThisProduct')}}</p>
                                    <div>
                                    <form method="post"  action="{{route('ForceDeleteProduct',$product->route)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ok" type="submit">yes</button>
                                    </form>
                                    <a href={{route('SoftDeleteProduct')}} class="cancel">{{__('admin.Cancel')}}</a>
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
    {{$products->links('pagination::bootstrap-5')}}

@endsection
