
{{-- <nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="container flex items-center justify-between h-16 px-4 mx-auto">
        <a href="" class="text-xl font-bold text-gray-800">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="flex items-center space-x-4">
            @guest
                @if (Route::has('login'))
                    <a href="{{ route('Admin.login') }}" class="font-medium text-gray-700 hover:text-blue-600">
                        {{ __('Login') }}
                    </a>
                @endif
            @else
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <span class="font-medium text-gray-800">{{ Auth::guard('admin')->user()->name }}</span>
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-48 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            {{ __('Profile Settings') }}
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav> --}}
<!-- Static design-only header below (no dynamic/auth logic) -->
<nav class="mt-4 bg-white border-b border-gray-200 shadow-sm">
    <div class="container flex items-center justify-between h-16 px-4 mx-auto">
        <a href="#" class="text-xl font-bold text-gray-800">
            AppName
        </a>
        <div class="flex items-center space-x-4">
             
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://ui-avatars.com/api/?name=Admin+Name&background=random" alt="Profile" class="object-cover w-8 h-8 rounded-full">
                    <span class="font-medium text-gray-800">Admin Name</span>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-48 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Profile Settings
                    </a>
                   <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- <nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('Admin.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                          
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('admin')->user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
