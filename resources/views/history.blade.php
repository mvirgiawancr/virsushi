<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order History - Vir Sushi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-sm shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Left side - Brand -->
                <a href="{{ route('dashboard') }}" class="font-bold text-2xl text-gray-800 flex items-center">
                    <span class="text-red-500 mr-2">🍣</span>
                    {{ config('app.name', 'Sushi Restaurant') }}
                </a>

                <!-- Right side - Username and Logout -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="btn btn-ghost text-sm text-gray-500 hover:text-red-500 transition-colors">
                        Menu
                    </a>
                    <div class="h-4 w-px bg-gray-200"></div>
                    <p class="text-gray-500 text-sm">{{ __('こんにちは, ') }} {{ Auth::user()->username }}</p>
                    <div class="h-4 w-px bg-gray-200"></div>
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

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Order History</h2>

            <div class="space-y-6">
                @foreach ($transactions as $transaction)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        Order #{{ $transaction->id }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $transaction->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                <span
                                    class="px-4 py-2 rounded-full text-sm 
                                    {{ $transaction->status == 'completed'
                                        ? 'bg-green-100 text-green-800'
                                        : ($transaction->status == 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>

                            <!-- Products -->
                            <div class="space-y-4">
                                @php
                                    $productData = json_decode($transaction->product_id, true);
                                @endphp

                                @foreach ($productData as $item)
                                    @php
                                        $product = DB::table('products')->find($item['id']);
                                    @endphp
                                    @if ($product)
                                        <div class="flex items-center justify-between py-2 border-b last:border-0">
                                            <div class="flex items-center space-x-4">
                                                <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-16 h-16 rounded-md object-cover" />
                                                <div>
                                                    <h4 class="font-medium">{{ $product->name }}</h4>
                                                    <p class="text-sm text-gray-500">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }} x
                                                        {{ $item['quantity'] }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-medium">Rp
                                                    {{ number_format($product->price * $item['quantity'], 0, ',', '.') }}
                                                </p>
                                                <p class="text-sm text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                @if (empty($productData))
                                    <p class="text-gray-500">No product details available</p>
                                @endif
                            </div>

                            <!-- Total -->
                            <div class="mt-4 pt-4 border-t">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium">Rp
                                        {{ number_format($transaction->total_amount / 1.1, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Tax (10%)</span>
                                    <span class="font-medium">Rp
                                        {{ number_format(($transaction->total_amount * 0.1) / 1.1, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-lg font-semibold">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($transactions->isEmpty())
                    <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
                        No order history found.
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>

</html>
