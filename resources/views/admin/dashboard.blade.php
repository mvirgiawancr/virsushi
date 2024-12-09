<x-app-layout>
    <div class="min-h-screen bg-gray-50"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ff9494\' fill-opacity=\'0.1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');">

        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-sm shadow-md">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Left side - Dashboard title -->
                    <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                        <span class="text-red-500 mr-2">🍣</span>
                        {{ __('Dashboard') }}
                    </h2>

                    <!-- Right side - Username and Logout -->
                    <div class="flex items-center space-x-4">
                        <p class="text-gray-500 text-sm">{{ __('こんにちは, ') }} {{ Auth::user()->username }}</p>
                        <div class="h-4 w-px bg-gray-200"></div> <!-- Vertical divider -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-ghost text-sm text-gray-500 hover:text-red-500 transition-colors"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Welcome Message -->
                <div
                    class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-lg mb-6 border-t-2 border-red-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Welcome Back!</h3>
                                <p class="text-gray-600">{{ __("You're logged in successfully.") }}</p>
                            </div>
                            <!-- Decorative Element -->
                            <div class="text-red-500 opacity-50">
                                <svg class="w-16 h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="40" fill="none" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M30,50 Q50,30 70,50 Q50,70 30,50" fill="currentColor" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Stat Card 1 -->
                    <x-today-orders />

                    <!-- Stat Card 2 -->
                    <x-active-menu />

                    <!-- Stat Card 3 -->
                    <x-total-customers />
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.orders.index') }}"
                            class="p-4 text-center rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <span class="block text-red-500 text-xl mb-2">📋</span>
                            <span class="text-sm text-gray-600">View Orders</span>
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                            class="p-4 text-center rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <span class="block text-red-500 text-xl mb-2">🍱</span>
                            <span class="text-sm text-gray-600">Manage Menu</span>
                        </a>
                        <a href="{{ route('admin.customers.index') }}"
                            class="p-4 text-center rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <span class="block text-red-500 text-xl mb-2">👥</span>
                            <span class="text-sm text-gray-600">Customers</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
