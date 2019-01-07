@extends('layouts.base')
@section('title', 'Login')
@section('content')
<div class="min-h-screen">
    <div class="container mx-auto min-h-screen flex flex-col justify-center items-center p-2">
        <h1 class="text-grey-darkest font-medium">Log in to your account</h1>

        <div class="py-4 text-sm text-grey-darker">
            Don't have an account yet? <a href="/register" class="no-underline text-blue">Sign up here</a>
        </div>

        <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 bg-white shadow rounded-lg p-4 shadow-lg">
            <div class="p-3">
                <button class="flex justify-center items-center rounded border border-grey-light w-full bg-white text-grey-darker text-xs py-3 px-4 focus:outline-none uppercase"
                    type="button">

                    <span class="pl-2"> Log in with Facebook </span>
                </button>
            </div>

            <div class="p-3">
                <button class="flex justify-center items-center rounded border border-grey-light w-full bg-white text-grey-darker text-xs py-2 px-4 focus:outline-none uppercase"
                    type="button">

                    <span>
                        <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><rect fill="#fff" height="40" rx="2" width="40" x="-11" y="-11"></rect><rect height="40" rx="2" width="40" x="-11" y="-11"></rect><rect height="40" rx="2" width="40" x="-11" y="-11"></rect><rect height="40" rx="2" width="40" x="-11" y="-11"></rect><g><g fill-rule="nonzero"><path d="m19.6 10.2272727c0-.70909088-.0636363-1.39090907-.1818182-2.04545452h-9.4181818v3.86818182h5.3818182c-.2318182 1.25-.9363636 2.3090909-1.9954545 3.0181818v2.509091h3.2318181c1.8909091-1.7409091 2.9818182-4.3045456 2.9818182-7.3500001z" fill="#4285f4"></path><path d="m10 20c2.7 0 4.9636363-.8954546 6.6181818-2.4227272l-3.2318181-2.509091c-.8954546.6-2.0409091.9545454-3.3863637.9545454-2.60454546 0-4.80909091-1.7590909-5.59545454-4.1227272h-3.3409091v2.5909091c1.64545455 3.2681818 5.02727273 5.5090909 8.93636364 5.5090909z" fill="#34a853"></path><path d="m4.40454546 11.9c-.2-.6-.31363637-1.2409091-.31363637-1.9 0-.65909091.11363637-1.3.31363637-1.9v-2.59090909h-3.3409091c-.67727272 1.35-1.06363636 2.87727272-1.06363636 4.49090909 0 1.6136363.38636364 3.1409091 1.06363636 4.4909091z" fill="#fbbc05"></path><path d="m10 3.97727272c1.4681818 0 2.7863637.50454546 3.8227272 1.49545456l2.8681819-2.86818182c-1.7318182-1.61363637-3.9954545-2.60454546-6.6909091-2.60454546-3.90909091 0-7.29090909 2.24090909-8.93636364 5.50909091l3.3409091 2.59090909c.78636363-2.36363637 2.99090908-4.12272728 5.59545454-4.12272728z" fill="#ea4335"></path></g><path d="m0 0h20v20h-20z"></path></g></g></svg>
                    </span>
                    <span class="pl-2"> Log in with Google &nbsp;&nbsp;</span>

                 </button>
            </div>

            <div class="px-3 py-2 flex justify-content-between items-center">
                <span class="flex-1 border-b border-grey-light"></span>
                <span class="px-2 text-grey-darker text-xs uppercase">or log in with</span>
                <span class="flex-1 border-b border-grey-light"></span>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="p-3">
                    <label for="email" class="block font-bold text-grey-darker text-xs mb-2">
                            Email
                    </label>
                    <input id="email" type="email" class="border border-grey-light focus:bg-white rounded w-full py-2 px-2 bg-grey-lighter {{ $errors->has('email') ? 'border-red' : '' }}"
                        name="email" value="{{ old('email') }}" required autofocus> @if ($errors->has('email'))
                    <p class="text-red text-xs pt-2" role="alert">
                        {{ $errors->first('email') }}
                    </p>
                    @endif
                </div>

                <div class="p-3">
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-grey-darker font-bold text-xs">
                            {{ __('Password') }}
                        </label>
                    </div>
                    <input id="password" type="password" class="border border-grey-light focus:bg-white rounded w-full py-2 px-2 bg-grey-lighter {{ $errors->has('password') ? ' border-red' : '' }}"
                        name="password" required> @if ($errors->has('password'))
                    <p class="ext-red text-xs pt-2" role="alert">
                        {{ $errors->first('password') }}
                    </p>
                    @endif
                </div>

                <div class="p-3 flex items-center justify-between">
                    <div>
                        <input class="mr-1" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

                        <label class="text-xs text-grey-darker" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                    </div>

                    <a class="inline-block align-baseline font-bold text-xs text-grey-darker no-underline hover:text-gery-darkest" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                             </a>
                </div>


                <div class="p-3 flex items-center justify-between">
                    <button class="rounded w-full bg-grey-darkest hover:bg-grey-darker text-white text-xs py-3 px-4 focus:outline-none focus:shadow-outline uppercase"
                        type="submit">
                        log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
