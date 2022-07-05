<x-guest-layout>
        @section('title') {{ __('auth.Verification_Email') }} @endsection

        @section('styles')
        @if(app()->getLocale() == 'en')
        <style>
            @media (max-width: 700px) {
                #Verify h1 {
                   left: 15%;
                }
            }
        </style>
        @endif
        @if(app()->getLocale() == 'ar')
        <style>
            @media (max-width: 700px) {
                #Verify h1 {
                    right: 15%;
                }
            }
        </style>
        @endif
        @endsection

            <section id="Verify">
                <h1>{{__('lang.Moda')}}</h1>
            </section>
            <div class="VerifyContent">
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
                <h1 class="VerifyTitle">{{__('auth.Verification_Email')}}</h1>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <p class="description">{{ __('auth.Verification_Email_Message') }}</p>
                    <input type="submit" class="submit" value="{{ __('auth.Resend') }}">
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" class="submit" value="{{ __('lang.Logout') }}">
                    @if (session('status') == 'verification-link-sent')
                    <p class="description">{{ __('auth.Verification_Email_Sent') }}</p>
                @endif
                </form>
            </div>

</x-guest-layout>
