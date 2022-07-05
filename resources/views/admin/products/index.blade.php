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

<div id="Product">
    <h1>{{__('admin.Show')}} {{__('admin.Product')}}</h1>
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
        <select name="category" id="categoryFilter" onchange="this.form.submit()">
            <option value={{__('admin.Category')}} selected disabled>{{__('admin.Category')}}</option>
            @foreach ($categories as $category)
                <option value="{{$category->route}}">{{$category->title}}</option>
            @endforeach
       </select>
     </form>
     <form method="get" action="#" class="filterBar" >
        <select name="subcategory" id="subcategoryFilter" onchange="this.form.submit()">
            <option value={{__('admin.SubCategory')}} selected disabled>{{__('admin.SubCategory')}}</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{$subcategory->route}}">{{$subcategory->title}}</option>
            @endforeach
       </select>
     </form>
    </div>
    <div class="actions">
        <a class="createProduct" href={{route('CreateProduct')}}><img src="{{asset('img/dashboard/drawer-add-svgrepo-com.svg')}}" alt="create" width="30px" height="30px"><p>{{__('admin.Create')}} {{__('admin.Product')}}</p></a>
        <a class="createProduct"href={{route('downloadcsvProduct')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="csv" width="30px" height="30px">Export as CSV</a>
        <a class="createProduct" href={{route('downloadxlsxProduct')}}><img src="{{asset('img/dashboard/paper-download-svgrepo-com.svg')}}" alt="xlsx" width="30px" height="30px">Export as XLSX</a>
        <a class="createProduct" href={{route('SoftDeleteProduct')}}><img src="{{asset('img/dashboard/green-recycle-trash-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">{{__('admin.trash')}}</a>
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
                <th>{{__('admin.Info')}}</th>
                <th>{{__('admin.Edit')}}</th>
                <th class="thend">{{__('admin.softDelete')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->count() == 0)
            <tr>
                <td colspan="10">{{ __('admin.noProduct') }}</td>
            </tr>
            @else
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>
                    <img class="headerImg" src="{{asset('storage/'.$product->image)}}" alt="{{$product->title}}" width="30px">
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

                <td class="infoProduct">
                    <a  href="/admin/Products/{{$product->route}}/info"><img src="{{asset('img/dashboard/info-circle-svgrepo-com.svg')}}" alt="info" width="30px" height="30px"></a>
                </td>
                <td class="editProduct">
                    <a  href="/admin/Products/{{$product->route}}/edit"><img src="{{asset('img/dashboard/edit-svgrepo-com.svg')}}" alt="edit" width="30px" height="30px"></a>
                </td>
                <td>
                    <div  onclick="myFunction2(this)">
                    <img src="{{asset('img/dashboard/trash-bin-svgrepo-com.svg')}}" alt="trash" width="30px" height="30px">
                        <div class="warning">
                            <div class="title">
                                <p class="warningTitle">{{__('admin.Warning')}}</p>
                            </div>
                            <div class="content">
                                <p class="alartMessage">{{__('admin.AreYouSureYouWantToputThisProductInTrash')}}</p>
                                <div>
                                <form method="post" action="{{route('DeleteProduct',$product->route)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ok" type="submit">yes</button>
                                </form>
                                <a href={{route('indexProduct')}} class="cancel">{{__('admin.Cancel')}}</a>
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
