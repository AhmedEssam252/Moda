@section('title') {{ __('lang.Login') }} @endsection

@section('styles')
@if(app()->getLocale() == 'en')
<style>
    @media (max-width: 700px) {
        #Login h1 {
        left: 15%;
        }
    }
</style>
@endif
@if(app()->getLocale() == 'ar')
<style>
    @media (max-width: 700px) {
        #Login h1 {
            right: 15%;
        }
    }
</style>
@endif
@endsection

<x-guest-layout>

    <section id="Login">
        <h1>{{__('lang.Moda')}}</h1>
        <a href="{{route('register')}}">{{__('auth.sign_up')}}</a>
    </section>
    <div class="LoginContent">
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
        <h1 class="LoginTitle">{{__('lang.Login')}}</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="label Email">
                <label for="email">{{__('auth.Email')}}</label>
                <input id="email" type="email" name="email" required autofocus />
            </div>

            <!-- Password -->
            <div class="label Password">
                <label for="password">{{__('auth.Password')}}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="loginOrForget">
                <!-- Remember Me -->
                    <label for="remember_me">
                        <input type="checkbox" name="remember" id="remember_me"/>
                        <span>{{ __('auth.Remember_Me') }}</span>
                    </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('auth.Forgot_Password') }}
                    </a>
                @endif
            </div>

            {{-- login --}}
            <input type="submit" class="submit" value={{ __('auth.Login') }} >

            <a href="{{ route('register') }}" class="goToSignUp">
                {{ __('auth.Dont_have_Email?') }}
            </a>
                {{-- go to resorces -> views -> components --}}
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            {{-- ------------------------------------------------------------- --}}
        </form>
    </div>
</x-guest-layout>
