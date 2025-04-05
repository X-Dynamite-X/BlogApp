@extends('layouts.app')

@section('title', 'Register')

@section('content')


    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-lg">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Create New Account</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="font-medium text-blue-600 transition-colors hover:text-blue-500 dark:text-blue-400">
                        Sign in
                    </a>
                </p>
            </div>

            <!-- Registration Form -->
            <form id="register-form" method="POST" action="{{ route('register') }}"
                class="space-y-6 rounded-xl bg-[#FDFDFC] p-8 shadow-lg transition-all duration-300 dark:bg-[#202020] dark:shadow-2xl">
                <!-- Username Field -->
                <div class="group relative">
                    <input type="text" name="name" id="name" required
                        class="peer w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                        placeholder=" " />
                    <label for="name"
                        class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm text-gray-500 duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                        Username
                    </label>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="group relative">
                    <input type="email" name="email" id="email" required
                        class="peer w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                        placeholder=" " />
                    <label for="email"
                        class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm text-gray-500 duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                        Email Address
                    </label>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="group relative">
                    <input type="password" name="password" id="password" required
                        class="peer w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                        placeholder=" " />
                    <label for="password"
                        class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm text-gray-500 duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                        Password
                    </label>
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="group relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="peer w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 text-gray-900 outline-none transition-all duration-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                        placeholder=" " />
                    <label for="password_confirmation"
                        class="absolute left-4 top-3 z-10 origin-[0] -translate-y-7 scale-75 transform bg-[#FDFDFC] px-2 text-sm text-gray-500 duration-300 peer-placeholder-shown:top-3 peer-placeholder-shown:-translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-3 peer-focus:-translate-y-7 peer-focus:scale-75 peer-focus:text-blue-600 dark:bg-[#202020] dark:text-gray-400 dark:peer-focus:text-blue-400">
                        Confirm Password
                    </label>
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="terms" name="terms" required
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 transition duration-150 ease-in-out focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-400" />
                    <label for="terms" class="text-sm text-gray-600 dark:text-gray-400">
                        I agree to the
                        <a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-400">Terms of Service</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full transform rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition-all duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                    Create Account
                </button>
            </form>
        </div>
    </div>

@endsection
