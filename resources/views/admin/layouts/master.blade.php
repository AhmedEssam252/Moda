<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @if(app()->getLocale() == 'ar')
        dir="rtl"
    @else
        dir="ltr"
    @endif>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{__('lang.Moda')}} | @yield('title') </title>
        <link rel="stylesheet" href="{{asset("css/web/necessary.css")}}">
        <link rel="stylesheet" href="{{asset('css/admin/adminList/add.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/sidebar.css')}}">
        @if(app()->getLocale() == 'ar')
        <style>
            #AdminNavbar{
               right: 0;
            }
            #AdminNavbar .FullView{
            right: 130%;
            z-index: 9;
            }
            #AdminNavbar .FullView{
                transform: rotate(180deg);
            }
            #AdminNavbar.active .FullView.active{
                transition: 0.6s ease-in-out;
                transform: rotate(0deg);
            }
            #AdminNavbar.active .FullView{
            right: 110%;
            }
            #AdminNavbar .links::after {
                right: -10px;
            }
            .Auth{
                border-radius:  0 0 80px 0px;
                left: 0;
            }
        </style>
        @else
        <style>
            .Auth{
                border-radius:  0 0 0 80px;
                right: 0;
            }
        </style>
        @endif
        @yield('styles')
    </head>
    <body>
        <div class="Auth">
            <div class="manageAccount">
                <p>{{__('lang.Welcome') . ' ' . Auth::user()->first_name}}</p>
                <img src="{{asset('img/Home/person.png')}}" alt="manageAccount" width="30px" height="30px">
            </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('AdminLogout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('lang.Logout') }}
            </x-dropdown-link>
        </form>
        </div>
        <nav id="AdminNavbar">
            <div class="brand">
                <h1>{{__('lang.Moda')}}</h1>
            </div>
            <img class="FullView" onclick="myFunction(this)" src="{{asset('img/dashboard/arrow-right-1-svgrepo-com.svg')}}" alt="arrow" width="30px" height="30px">
            <div class="listItems">
                <a href={{route('Dashboard')}} class="links">
                    <img src="{{asset('img/dashboard/graph-svgrepo-com.svg')}}" alt="Dashboard Icon" width="30px" height="30px">
                    <p>{{__('admin.Dashboard')}}</p>
                </a>
                <a href={{route('indexCategory')}} class="links">
                    <img src="{{asset('img/dashboard/lables-svgrepo-com.svg')}}" alt="Categories Icon" width="30px" height="30px">
                    <p>{{__('admin.Categories')}}</p>
                </a>
                <a href={{route('indexSubCategory')}} class="links">
                    <img src="{{asset('img/dashboard/lable-svgrepo-com.svg')}}" alt="SubCategories Icon" width="30px" height="30px">
                    <p>{{__('admin.SubCategories')}}</p>
                </a>
                <a href={{route('indexProduct')}} class="links">
                    <img src="{{asset('img/dashboard/bag-svgrepo-com.svg')}}" alt="Products Icon" width="30px" height="30px">
                    <p>{{__('admin.Products')}}</p>
                </a>
                <a href="{{route('indexRequest')}}" class="links">
                    <img src="{{asset('img/dashboard/clipboard-text-svgrepo-com.svg')}}" alt="Castomar Requests Icon" width="30px" height="30px">
                    <p>{{__('admin.CastomarRequests')}}</p>
                </a>
                <a href="{{route('indexUser')}}" class="links">
                    <img src="{{asset('img/dashboard/group-svgrepo-com.svg')}}" alt="Users Icon" width="30px" height="30px">
                    <p>{{__('admin.Users')}}</p>
                </a>
                <a href="{{route('indexAdmin')}}" class="links">
                    <img src="{{asset('img/dashboard/user-svgrepo-com.svg')}}" alt="Users Icon" width="30px" height="30px">
                    <p>{{__('admin.Admins')}}</p>
                </a>
                <a href="#" class="links">
                    <img src="{{asset('img/dashboard/key-svgrepo-com.svg')}}" alt="Permissions Icon" width="30px" height="30px">
                    <p>{{__('admin.Permissions')}}</p>
                </a>
                <a href="#" class="links last">
                    <img src="{{asset('img/dashboard/setting-svgrepo-com.svg')}}" alt="Settings Icon" width="30px" height="30px">
                    <p>{{__('admin.Settings')}}</p>
                </a>
            </div>
        </nav>
        @yield('content')
        <script src="{{asset('js/admin/dashboard.js')}}"></script>
    </body>
    </html>
