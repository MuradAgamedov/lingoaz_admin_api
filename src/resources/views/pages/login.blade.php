@extends('layout.auth')

@section('content')
<div class="relative min-h-screen w-full flex justify-center items-center py-16 md:py-10">
    <div class="card md:w-lg w-screen z-10">
        <div class="text-center px-10 py-12">
            <!-- Logo -->
            <a href="index.html" class="flex justify-center">
                <img src="{{asset('assets/logo-dark-BRT9tiBX.png')}}" alt="logo dark" class="h-6 flex dark:hidden">
                <img src="{{asset('assets/logo-light-CCjoJosn.png')}}" alt="logo light" class="h-6 hidden dark:flex" alt="">
            </a>

            <div class="mt-8 text-center">
                <h4 class="mb-2.5 text-xl font-semibold text-primary">Welcome Back !</h4>
                <p class="text-base text-default-500">Sign in to continue to Tailwick.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="text-left w-full mt-10">
                <div class="mb-4">
                    <label for="email" class="block font-medium text-default-900 text-sm mb-2">Email </label>
                    <input type="text" id="email" name="email" class="form-input" placeholder="Enter email" value="{{ old('email') }}" />
                    @include('layout.includes.alerts._error', ['field' => 'email'])
                </div>

                <div class="mb-4">
                    <a href="auth-basic-reset-password.html" class="text-primary font-medium text-sm mb-2 float-end">Forgot Password ?</a>
                    <label for="password" class="block font-medium text-default-900 text-sm mb-2">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Enter Password" value="{{ old('password') }}" />
                    @include('layout.includes.alerts._error', ['field' => 'password'])
                </div>

                <div class="flex items-center gap-2 mb-4">
                    <input @checked(old('remember')) id="checkbox-1" type="checkbox" name="remember" class="form-checkbox" value="1" />
                    <label class="text-default-900 text-sm font-medium" for="checkbox-1">Remember Me</label>
                </div>
                @include('layout.includes.alerts.error')

                <div class="mt-10 text-center">
                    <button type="submit" class="btn bg-primary text-white w-full">Sign In<button>
                </div>

            </form>
        </div>
    </div>

    <div class="absolute inset-0 overflow-hidden">
        <svg aria-hidden="true" class="absolute inset-0 size-full fill-black/2 stroke-black/5 dark:fill-white/2.5 dark:stroke-white/2.5">
            <defs>
                <pattern id="authPattern" width="56" height="56" patternUnits="userSpaceOnUse" x="50%" y="16">
                    <path d="M.5 56V.5H72" fill="none"></path>
                </pattern>
            </defs>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#authPattern)"></rect>
        </svg>
    </div>
</div>
@endsection
