@extends('layouts.base', [
    'title' => 'Login',
    'includingNav' => false,
    'includingFooter' => false
])

@section('head.links')
<link href="{{ asset('css/base.css') }}" rel="stylesheet">
@endsection

@section('base.content')
<div class="min-h-screen bg-grey-lightest">
    <div class="container mx-auto min-h-screen flex justify-center items-center">
         <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 bg-white shadow rounded p-4">
            <div class="p-3">{{ __('Login') }}</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="p-3">
                    <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                            {{ __('E-Mail Address') }}
                    </label>
                    <input
                        id="email"
                        type="email"
                        class="border border-grey rounded w-full py-3 px-4 {{ $errors->has('email') ? 'border-red' : '' }}"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus>

                    @if ($errors->has('email'))
                    <p class="text-red text-xs" role="alert">
                        {{ $errors->first('email') }}
                    </p>
                    @endif
                </div>

                 <div class="p-3">
                    <div class="flex items-center justify-between mb-2">
                        <label
                            for="password"
                            class="block text-grey-darker text-sm font-bold">
                            {{ __('Password') }}
                        </label>
                        <a
                            class="inline-block align-baseline font-bold text-xs text-grey-darker no-underline hover:text-blue-darker"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                         </a>
                    </div>
                    <input
                        id="password"
                        type="password"
                        class="border border-grey rounded w-full py-3 px-4 {{ $errors->has('password') ? ' border-red' : '' }}"
                        name="password"
                        required>

                    @if ($errors->has('password'))
                    <p class="ext-red text-xs" role="alert">
                        {{ $errors->first('password') }}
                    </p>
                    @endif
                </div>

                <div class="p-3 flex items-center">
                    <input
                        class="mr-2"
                        type="checkbox"
                        name="remember"
                        id="remember" {{ old( 'remember') ? 'checked' : '' }}>

                    <label class="text-sm text-grey-darker" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                 <div class="p-3 flex items-center justify-between">
                    <button
                        class="w-full bg-blue hover:bg-blue-dark text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        {{ __('Login') }}
                    </button>
                 </div>
           </form>
        </div>
    </div>
</div>
@endsection
