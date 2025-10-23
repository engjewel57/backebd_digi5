@extends('backend.user.layouts.master')

@section('title', 'Profile')
@section('content')
{{__('This is user profile!')}}

{{(Auth::user()->name)}}

 <nav class="bg-white shadow-lg">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">Dashboard</h1>
                </div>
                
                <!-- Desktop Menu -->
                <div class="items-center hidden space-x-4 md:flex">
                    <span class="text-gray-700">Welcome, <span id="username" class="font-semibold">John Doe</span></span>
                   <div class="dropdown-divider"></div>
                @if (Route::has('logout'))
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endif
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="text-gray-700 md:hidden hover:text-gray-900 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-white border-t md:hidden">
            <div class="px-4 py-3 space-y-3">
                <div class="text-gray-700">Welcome, <span class="font-semibold">John Doe</span></div>
                <button onclick="handleLogout()" class="w-full px-4 py-2 text-white transition duration-200 bg-red-500 rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Users</p>
                        <p class="text-3xl font-bold text-gray-800">1,234</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Revenue</p>
                        <p class="text-3xl font-bold text-gray-800">$45.2K</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Orders</p>
                        <p class="text-3xl font-bold text-gray-800">567</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Growth</p>
                        <p class="text-3xl font-bold text-gray-800">+23%</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Activity</h2>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 transition duration-150 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 font-semibold text-white bg-blue-500 rounded-full">
                                JD
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">New user registered</p>
                                <p class="text-sm text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 transition duration-150 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 font-semibold text-white bg-green-500 rounded-full">
                                AS
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Order #1234 completed</p>
                                <p class="text-sm text-gray-500">15 minutes ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 transition duration-150 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-10 h-10 font-semibold text-white bg-purple-500 rounded-full">
                                MK
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Payment received</p>
                                <p class="text-sm text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logging out...');
                // In a real application, you would:
                // 1. Clear session/auth tokens
                // 2. Redirect to login page
                // window.location.href = '/login';
            }
        }
    </script>

@endsection