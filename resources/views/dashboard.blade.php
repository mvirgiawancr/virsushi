<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vir Sushi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-sm shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Left side - Brand -->
                <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                    <span class="text-red-500 mr-2">🍣</span>
                    {{ config('app.name', 'Sushi Restaurant') }}
                </h2>

                <!-- Right side - Username and Logout -->
                <div class="flex items-center space-x-4">
                    <p class="text-gray-500 text-sm">{{ __('こんにちは, ') }} {{ Auth::user()->username }}</p>
                    <div class="h-4 w-px bg-gray-200"></div>
                    <a href="{{ route('history') }}"
                        class="btn btn-ghost text-sm text-gray-500 hover:text-red-500 transition-colors">
                        Order History
                    </a>
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

    <!-- Main Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Status Messages -->
            @if (session('success'))
                <div
                    class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Menu</h3>
            <!-- Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Menu Item 1 -->
                @foreach ($product as $data)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="data:image/jpeg;base64,{{ base64_encode($data->image) }}" alt="Sushi Roll"
                            class="w-full h-48 object-cover" />
                        <div class="p-4">
                            <h4 class="font-semibold text-lg mb-2">{{ $data->name }}</h4>
                            <p class="text-gray-600 text-sm mb-4">{{ $data->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-red-500 font-semibold">Rp
                                    {{ number_format($data->price, 0, ',', '.') }}</span>
                                <form method="POST" action="{{ route('cart.add', $data->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                                        Tambahkan Pesanan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Shopping Cart -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pesanan Anda</h3>
                <div class="space-y-4">
                    @php
                        $cart = session('cart', []); // Pastikan mengambil session terbaru
                    @endphp

                    @if ($cart)
                        @foreach ($cart as $id => $item)
                            <div class="flex items-center justify-between pb-4 border-b">
                                <div class="flex items-center space-x-4">
                                    <img src="data:image/jpeg;base64,{{ $item['image'] }}" alt="Menu item"
                                        class="w-16 h-16 rounded-md object-cover" />
                                    <div>
                                        <h4 class="font-medium">{{ $item['name'] }}</h4>
                                        <p class="text-sm text-gray-500">Rp
                                            {{ number_format($item['price'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('cart.update', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}"
                                                class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-500"
                                                {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>
                                        <span class="text-gray-600">{{ $item['quantity'] }}</span>
                                        <form action="{{ route('cart.update', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                                class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-500">+</button>
                                        </form>
                                    </div>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:text-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <!-- Total -->
                        <div class="pt-4 border-t">
                            @php
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['price'] * $item['quantity'];
                                }
                            @endphp
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-4">
                                <span class="text-gray-600">Tax (10%)</span>
                                <span class="font-medium">Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Total</span>
                                <span>Rp {{ number_format($total + $total * 0.1, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <button
                                class="w-full py-3 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors mt-4">
                                Proceed to Checkout
                            </button>
                        </form>
                    @else
                        <p class="text-gray-500">Anda belum memiliki pesanan.</p>
                    @endif
                </div>


            </div>
    </main>
</body>

</html>
