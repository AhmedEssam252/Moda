@section('title') {{ __('auth.Forget_Password') }} @endsection

@section('styles')
@if(app()->getLocale() == 'en')
<style>
    @media (max-width: 700px) {
        #ForgetPassword h1 {
        left: 15%;
        }
    }
</style>
@endif
@if(app()->getLocale() == 'ar')
<style>
    @media (max-width: 700px) {
        #ForgetPassword h1 {
            right: 15%;
        }
    }
</style>
@endif
@endsection
<x-guest-layout>
    <section id="ForgetPassword">
        <h1>{{__('lang.Moda')}}</h1>
        <a href="{{route('login')}}">{{__('auth.Did_You_Remember_The_Password?')}}</a>
    </section>
    <div class="ForgetContent">
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
        <h1 class="ForgetTitle">{{__('auth.Reset_Password')}}</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <p class="description">{{ __('auth.Forgot_your_password_Message') }}</p>
            <!-- Email Address -->
            <div class="label">
                <label for="email">{{__('auth.Email')}}</label>

                <input id="email" class="" type="email" name="email" required autofocus />
            </div>

            <div class="">
                <input type="submit" class="submit" value="{{ __('auth.Reset') }}">
                        <!-- Session Status -->
                <x-auth-session-status class="" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="" :errors="$errors" />
            </div>
        </form>
    </div>
</x-guest-layout>
