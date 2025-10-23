@extends('backend.admin.layouts.master')

@section('title', 'Dashboard')
@section('content')



        

      

        <!-- Stats Cards with hover grow effect -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- Users Card -->
            <div class="flex items-center p-6 transition-transform duration-200 transform bg-white rounded-lg shadow hover:scale-105">
                <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold">1,245</div>
                    <div class="text-gray-500">Users</div>
                </div>
            </div>
            <!-- Sales Card -->
            <div class="flex items-center p-6 transition-transform duration-200 transform bg-white rounded-lg shadow hover:scale-105">
                <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h2l1 2h13a1 1 0 010 2H6l-1-2H3v-2zm0 0V7a4 4 0 014-4h10a4 4 0 014 4v3" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold">$9,876</div>
                    <div class="text-gray-500">Sales</div>
                </div>
            </div>
            <!-- Orders Card -->
            <div class="flex items-center p-6 transition-transform duration-200 transform bg-white rounded-lg shadow hover:scale-105">
                <div class="p-3 mr-4 text-yellow-600 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-2a4 4 0 018 0v2m-4-4a4 4 0 100-8 4 4 0 000 8zm6 8H6a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2v2h4V7a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold">320</div>
                    <div class="text-gray-500">Orders</div>
                </div>
            </div>
            <!-- Revenue Card -->
            <div class="flex items-center p-6 transition-transform duration-200 transform bg-white rounded-lg shadow hover:scale-105">
                <div class="p-3 mr-4 text-purple-600 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 7v7" />
                    </svg>
                </div>
                <div>
                    <div class="text-2xl font-bold">$12,345</div>
                    <div class="text-gray-500">Revenue</div>
                </div>
            </div>
        </div>

        </div>

   




{{-- {{__('This is admin dashboard!')}} --}}
@endsection