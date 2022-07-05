<x-guest-layout>
    @section('title') {{ __('auth.Reset_Password') }} @endsection

    @section('styles')
    @if(app()->getLocale() == 'en')
    <style>
        @media (max-width: 700px) {
            #ResetPassword h1 {
               left: 15%;
            }
        }
    </style>
    @endif
    @if(app()->getLocale() == 'ar')
    <style>
        @media (max-width: 700px) {
            #ResetPassword h1 {
                right: 15%;
            }
        }
    </style>
    @endif
    @endsection
        <section id="ResetPassword">
            <h1>{{__('lang.Moda')}}</h1>
        </section>
        <div class="ResetContent">
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
            <h1 class="ResetTitle">{{__('auth.Reset_Password')}}</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email">{{__('auth.Email')}}</label>

                    <input id="email" class="" type="email" name="email" required autofocus />
                </div>

                <!-- Password -->
                <div class="">
                    <label for="password">{{__('auth.Password')}}</label>

                    <input id="password" class="" type="password" name="password" required />
                </div>

                <!-- Confirm Password -->
                <div class="">
                    <label for="password_confirmation">{{__('auth.Confirm_Password')}}</label>

                    <input id="password_confirmation" class=""
                                        type="password"
                                        name="password_confirmation" required />
                </div>

                <div class="">
                    <input type="submit" class="submit" value="{{ __('auth.Reset') }}">
                </div>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="" :errors="$errors" />
            </form>
        </div>

</x-guest-layout>
