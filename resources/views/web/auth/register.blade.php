<x-guest-layout>

        @section('title') {{ __('auth.sign_up') }} @endsection

        @section('styles')
        <style>
            #signUp{
                height: 140vh !important;
            }
        </style>
        @if(app()->getLocale() == 'en')
        <style>
            @media (max-width: 700px) {
                #signUp h1 {
                   left: 15%;
                }
            }
        </style>
        @endif
        @if(app()->getLocale() == 'ar')
        <style>
            @media (max-width: 700px) {
                #signUp h1 {
                    right: 15%;
                }
            }
        </style>
        @endif
        @endsection
            <section id="signUp">
                <h1>{{__('lang.Moda')}}</h1>
                <a href="{{route('login')}}">{{__('auth.Login')}}</a>
            </section>
            <div class="signContent">
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
                <h1 class="LoginTitle">{{__('auth.sign_up')}}</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="label">
                        <label for="FirstName">{{__('admin.FirstName')}}</label>

                        <input id="FirstName" type="text" name="FirstName" required autofocus />
                    </div>
                    @error('FirstName')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <div class="label">
                        <label for="LastName">{{__('admin.LastName')}}</label>

                        <input id="LastName" type="text" name="LastName" required autofocus />
                    </div>
                    @error('LastName')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <!-- Email Address -->
                    <div class="label">
                        <label for="email">{{__('auth.Email')}}</label>

                        <input id="email" class="" type="email" name="email" required />
                    </div>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <!-- Password -->
                    <div class="label">
                        <label for="password">{{__('auth.Password')}}</label>

                        <input id="password"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <!-- Confirm Password -->
                    <div class="label">
                        <label for="password_confirmation">{{__('auth.Confirm_Password')}}</label>

                        <input id="password_confirmation" class=""
                                        type="password"
                                        name="password_confirmation" required />
                    </div>
                    @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <div class="signOrLogin">
                        <input type="submit" class="submit"  value="{{ __('auth.sign_up') }}">
                        <a class="" href="{{ route('login') }}">
                            {{ __('auth.Already_Registered?') }}
                        </a>
                    </div>
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </form>
            </div>

</x-guest-layout>
