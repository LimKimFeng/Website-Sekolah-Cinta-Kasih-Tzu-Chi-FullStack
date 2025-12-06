@extends('layouts.app')

@section('title', __('Login') . ' - Sekolah Cinta Kasih Tzu Chi')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 -mt-20">
    <div class="max-w-md w-full bg-white rounded-[2rem] shadow-glass overflow-hidden p-8 md:p-10 border border-gray-100 relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full blur-2xl -mr-10 -mt-10"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-accent/10 rounded-full blur-2xl -ml-10 -mb-10"></div>

        <div class="text-center mb-8 relative z-10">
            <a href="{{ url('/') }}" class="inline-block mb-4">
                <img src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2020/12/Main-Logo.png" alt="Logo" class="h-16 mx-auto">
            </a>
            <h2 class="text-3xl font-bold text-gray-900">{{ __('Selamat Datang') }}</h2>
            <p class="text-gray-500 mt-2">{{ __('Silakan masuk ke akun Anda') }}</p>
        </div>

        <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            
            <div class="space-y-4">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full pl-11 pr-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all placeholder-gray-400" placeholder="{{ __('Email Address') }}" required>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="password" id="password" class="block w-full pl-11 pr-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all placeholder-gray-400" placeholder="{{ __('Password') }}" required>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-600 cursor-pointer hover:text-gray-900">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="ml-2">{{ __('Ingat Saya') }}</span>
                </label>
                <a href="#" class="font-medium text-primary hover:text-primary-dark">{{ __('Lupa Password?') }}</a>
            </div>

            <div class="flex justify-center mb-4">
                <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-primary to-primary-light text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                {{ __('Masuk') }}
            </button>

            <p class="text-center text-gray-500 text-sm mt-6">
                {{ __('Belum punya akun?') }} <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">{{ __('Daftar disini') }}</a>
            </p>
        </form>
    </div>
</div>
@endsection
