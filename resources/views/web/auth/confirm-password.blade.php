@section('title') {{ __('auth.Confirm_Password') }} @endsection

@section('styles')
@if(app()->getLocale() == 'en')
<style>
    @media (max-width: 700px) {
        #ConfirmPassword h1 {
        left: 15%;
        }
    }
</style>
@endif
@if(app()->getLocale() == 'ar')
<style>
    @media (max-width: 700px) {
        #ConfirmPassword h1 {
            right: 15%;
        }
    }
</style>
@endif
@endsection
<x-guest-layout>
    <section id="ConfirmPassword">
        <h1>{{__('lang.Moda')}}</h1>
    </section>
    <div class="ConfirmContent">
        <section id="search">
            <div class="topSearch">
                <a href="{{route('Back')}}" class="back" type="submit">
                    <picture>
                       <source media="(max-width:700px)" srcset="{{asset('img/Home/back-mobile-svgrepo-com.svg')}}">
                       <img src="{{asset('img/Home/back-svgrepo-com.svg')}}" alt="back" width="50" height="50">
                   </picture>
                 </a>
            </div>
        </section>
        <h1 class="ConfirmTitle">{{__('auth.Confirm_Password')}}</h1>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <p class="description">{{ __('auth.Confirm_Password_Message') }}</p>
            <!-- Password -->
            <div>
                <label for="password">{{__('auth.Password')}}</label>
                <input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="{{__('auth.Confirm_Password_Placeholder')}}" />
            </div>
            <div class="">
                <input type="submit" class="submit" value="{{ __('auth.Confirm') }}">
            </div>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="" :errors="$errors" />
        </form>
    </div>
</x-guest-layout>
