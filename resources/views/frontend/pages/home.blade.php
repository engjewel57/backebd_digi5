@extends('frontend.layouts.master')

@section('title', 'Home')
@section('content')
   <section class="home">
        <div class="container max-w-6xl mx-auto">
        <h1 class="mb-12 text-4xl font-bold text-center text-gray-800">Welcome</h1>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            
            <!-- User Login Card -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">User Login</h2>
                <p class="mb-6 text-center text-gray-600">Sign in to your account</p>
                <form action="{{ route('login') }}" mathod="POST" class="space-y-4">
                    @csrf
                   
                    <button type="submit" class="w-full py-2 font-semibold text-white transition-colors duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">Login</button>
                </form>
            </div>

            <!-- User Register Card -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">User Register</h2>
                <p class="mb-6 text-center text-gray-600">Create a new account</p>
                <form action="{{ route('register') }}" mathod="POST" class="space-y-4">
                    @csrf
                    <button type="submit" class="w-full py-2 font-semibold text-white transition-colors duration-300 bg-green-600 rounded-lg hover:bg-green-700">Register</button>
                </form>
            </div>

            <!-- Admin Login Card -->
            <div class="p-6 transition-shadow duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl md:col-span-2 lg:col-span-1 md:mx-auto md:max-w-sm lg:max-w-none">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">Admin Login</h2>
                <p class="mb-6 text-center text-gray-600">Administrator access only</p>
                <form action="{{ route('admin.login') }}" mathod="POST" class="space-y-4">
                    @csrf
                    <button type="submit" class="w-full py-2 font-semibold text-white transition-colors duration-300 bg-purple-600 rounded-lg hover:bg-purple-700">Admin Login</button>
                </form>
            </div>

        </div>
    </div>
    </section>

@endsection