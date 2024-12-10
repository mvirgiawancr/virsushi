<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vir Sushi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Hero Section -->
    <div class="hero min-h-screen" style="background-image: url('{{ asset('images/background.jpg') }}');" id="home">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Vir Sushi</h1>
                <p class="mb-5">Nikmati pengalaman kuliner Jepang autentik dengan bahan-bahan premium terbaik.</p>
                <a class="btn btn-error text-white" href="#menu">Lihat Menu</a>
            </div>
        </div>
    </div>

    <!-- Featured Menu Section -->
    <div class="py-20" id="menu">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold">Menu Favorit</h2>
            <div class="divider"></div>
        </div>

        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($product->take(3) as $data)
                    <div class="card bg-base-100 shadow-xl">
                        <figure>
                            <img src="data:image/jpeg;base64,{{ base64_encode($data->image) }}"
                                alt="{{ $data->name }}" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $data->name }}</h2>
                            <p>{{ $data->description }}</p>
                            <div class="card-actions justify-between items-center">
                                <span class="text-error text-xl font-bold">Rp
                                    {{ number_format($data->price, 0, ',', '.') }}</span>
                                <a class="btn bg-white hover:bg-error text-error hover:text-white "
                                    href='{{ route('login') }}'>Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-span-full text-center mt-6">
                    <a class="btn bg-error/90 hover:bg-error text-white" href="{{ route('login') }}">Lihat
                        Semua</a>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="bg-base-200 py-20" id="about">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 400">
                        <!-- Background -->
                        <rect width="800" height="400" fill="#fff7ed" />

                        <!-- Decorative Japanese Pattern Background -->
                        <path
                            d="M0 0 L800 0 L800 50 Q750 60, 700 50 Q650 40, 600 50 Q550 60, 500 50 Q450 40, 400 50 Q350 60, 300 50 Q250 40, 200 50 Q150 60, 100 50 Q50 40, 0 50 Z"
                            fill="#ff9494" opacity="0.2" />

                        <!-- Main Plate -->
                        <ellipse cx="400" cy="200" rx="150" ry="40" fill="#f5f5f5"
                            stroke="#666" stroke-width="2" />

                        <!-- Sushi Rolls -->
                        <g transform="translate(320,180)">
                            <!-- Sushi Roll 1 -->
                            <rect x="0" y="0" width="40" height="30" rx="5" fill="#fff" stroke="#333"
                                stroke-width="2" />
                            <rect x="5" y="5" width="30" height="20" rx="3" fill="#ff8c42" />
                            <line x1="10" y1="15" x2="30" y2="15" stroke="#fff"
                                stroke-width="2" />
                        </g>

                        <g transform="translate(380,180)">
                            <!-- Sushi Roll 2 -->
                            <rect x="0" y="0" width="40" height="30" rx="5" fill="#fff" stroke="#333"
                                stroke-width="2" />
                            <rect x="5" y="5" width="30" height="20" rx="3" fill="#ff8c42" />
                            <line x1="10" y1="15" x2="30" y2="15" stroke="#fff"
                                stroke-width="2" />
                        </g>

                        <!-- Chopsticks -->
                        <line x1="280" y1="160" x2="460" y2="160" stroke="#8b4513"
                            stroke-width="4" />
                        <line x1="280" y1="170" x2="460" y2="170" stroke="#8b4513"
                            stroke-width="4" />

                        <!-- Japanese Characters -->
                        <text x="350" y="300" font-family="Arial" font-size="24" fill="#333"
                            text-anchor="middle">Vir Sushi</text>

                        <!-- Decorative Elements -->
                        <circle cx="200" cy="100" r="20" fill="#ff9494" opacity="0.5" />
                        <circle cx="600" cy="100" r="20" fill="#ff9494" opacity="0.5" />
                        <circle cx="200" cy="300" r="20" fill="#ff9494" opacity="0.5" />
                        <circle cx="600" cy="300" r="20" fill="#ff9494" opacity="0.5" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-4xl font-bold mb-6">Tentang Vir Sushi</h2>
                    <p class="py-6">Vir Sushi hadir dengan visi menghadirkan cita rasa autentik Jepang di Indonesia.
                        Dengan pengalaman lebih dari 10 tahun, kami berkomitmen menggunakan bahan-bahan premium dan
                        fresh untuk memberikan pengalaman kuliner terbaik.</p>
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="stat-title">Years of Experience</div>
                            <div class="stat-value text-primary">10+</div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Special Menus</div>
                            <div class="stat-value text-primary">50+</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer p-10 bg-neutral text-neutral-content">
        <div>
            <span class="footer-title">Company</span>
            <a class="link link-hover" href="#about">About us</a>
            <a class="link link-hover" href="#menu">Menu</a>
        </div>
        <div>
            <span class="footer-title">Opening Hours</span>
            <p>Senin - Jumat: 11:00 - 22:00</p>
            <p>Sabtu - Minggu: 11:00 - 23:00</p>
        </div>
        <div>
            <span class="footer-title">Contact</span>
            <p>10122164</p>
            <p>Moch Virgiawan Caesar Ridollohi</p>
            <p>IF 5</p>
        </div>
    </footer>
    <footer class="footer px-10 py-4 border-t bg-neutral text-neutral-content border-base-300">
        <div class="items-center grid-flow-col">
            <p>© 2024 Vir Sushi. All rights reserved.</p>
        </div>
        <div class="md:place-self-center md:justify-self-end">
        </div>
    </footer>
</body>

</html>
