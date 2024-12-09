<x-guest-layout>
    <div class="fixed inset-0 flex items-center justify-center overflow-hidden"
        style="background-color: #f5f5f5; background-image: url("data:image/svg+xml,%3Csvg
        xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg
        fill-rule='evenodd'%3E%3Ccircle fill='%23ff9494' fill-opacity='0.1' cx='50' cy='50' r='10' /%3E%3Cpath
        fill='%23000' fill-opacity='0.05'
        d='M50 0C22.4 0 0 22.4 0 50s22.4 50 50 50 50-22.4 50-50S77.6 0 50 0zm0 80c-16.6 0-30-13.4-30-30s13.4-30 30-30 30 13.4 30 30-13.4 30-30 30z'
        /%3E%3C/g%3E%3C/svg%3E"), url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80'
        height='80' viewBox='0 0 80 80'%3E%3Cg fill='none' stroke='%23ff9494' stroke-width='1'
        stroke-opacity='0.1'%3E%3Cpath d='M0 0h80v80H0z' /%3E%3Cpath
        d='M0 20h80M0 40h80M0 60h80M20 0v80M40 0v80M60 0v80' /%3E%3C/g%3E%3C/svg%3E");">

        <!-- Decorative Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute top-0 left-0 w-32 h-32 text-red-200 opacity-20">
                <path d="M0,0 L100,0 Q150,50 100,100 L0,100 Z" fill="currentColor" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 right-0 w-32 h-32 text-red-200 opacity-20"
                style="transform: rotate(180deg)">
                <path d="M0,0 L100,0 Q150,50 100,100 L0,100 Z" fill="currentColor" />
            </svg>
        </div>

        <div class="bg-white/90 backdrop-blur-sm p-8 rounded-lg shadow-xl w-96 space-y-6 relative">
            <!-- Japanese Pattern Top -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-red-500 rounded-t-lg opacity-80"></div>

            <!-- Header -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">ようこそ</h1>
                <p class="text-gray-500 text-sm">Welcome Back</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Username -->
                <div>
                    <x-input-label for="username" :value="__('Username')" class="text-gray-700" />
                    <x-text-input id="username"
                        class="block w-full px-4 py-2 mt-1 text-gray-700 bg-gray-50 border border-gray-200 rounded-md focus:border-red-400 focus:ring-red-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                        type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input id="password"
                        class="block w-full px-4 py-2 mt-1 text-gray-700 bg-gray-50 border border-gray-200 rounded-md focus:border-red-400 focus:ring-red-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Don't Have an Account? Link -->
                <div class="text-right">

                    <a class="text-sm text-red-500 hover:text-red-600 hover:underline" href="{{ route('register') }}">
                        {{ __('Don\'t have an account?') }}
                    </a>

                </div>

                <!-- Login Button -->
                <div>
                    <x-primary-button
                        class="w-full justify-center py-2 px-4 bg-red-600 hover:bg-red-700 focus:ring-red-500">
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Japanese Pattern Bottom -->
            <div class="absolute bottom-0 left-0 right-0 h-2 bg-red-500 rounded-b-lg opacity-80"></div>
        </div>
    </div>

    <style>
        /* Custom Japanese Pattern Background */
        .japanese-pattern {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ff9494' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</x-guest-layout>
