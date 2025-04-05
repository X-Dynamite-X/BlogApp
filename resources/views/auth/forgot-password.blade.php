


@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="flex min-h-screen items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Forgot Password</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Enter your email address and we'll send you a link to reset your password.
            </p>
        </div>

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6 rounded-xl bg-[#FDFDFC] p-8 shadow-lg transition-all duration-300 dark:bg-[#202020] dark:shadow-2xl">
            @csrf

            <!-- Email Field -->
            <div class="group relative">
                <input type="email" name="email" id="email" required
                    class="peer w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    placeholder=" " />
                <label for="email"
                    class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm text-gray-500 duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                    Email Address
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full transform rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition-all duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                Send Reset Link
            </button>

            <!-- Back to Login -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400">
                    Back to login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
