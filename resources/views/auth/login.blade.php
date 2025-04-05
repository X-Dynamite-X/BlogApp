


@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex min-h-screen items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Welcome Back</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-blue-600 transition-colors hover:text-blue-500 dark:text-blue-400">
                    Sign up
                </a>
            </p>
        </div>

        <!-- Login Form -->
        <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-6 rounded-xl bg-[#FDFDFC] p-8 shadow-lg transition-all duration-300 dark:bg-[#202020] dark:shadow-2xl">
            @csrf

            <!-- Validation Errors -->
            <x-validation-errors />

            <!-- Status Message -->
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-600 dark:border-green-800 dark:bg-green-900/50 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Email Field -->
            <div class="group relative">
                <input type="email" name="email" id="email" required
                    class="peer w-full rounded-lg border @error('email') border-red-500 @else border-gray-300 @enderror bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    placeholder=" " value="{{ old('email') }}" />
                <label for="email"
                    class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm @error('email') text-red-500 @else text-gray-500 @enderror duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                    Email Address
                </label>
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="group relative">
                <input type="password" name="password" id="password" required
                    class="peer w-full rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    placeholder=" " />
                <label for="password"
                    class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm @error('password') text-red-500 @else text-gray-500 @enderror duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                    Password
                </label>
                @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 transition duration-150 ease-in-out focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-400" />
                    <label for="remember" class="text-sm text-gray-600 dark:text-gray-400">
                        Remember me
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400">
                    Forgot password?
                </a>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full transform rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition-all duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                Sign In
            </button>
        </form>
    </div>
</div>
@endsection

