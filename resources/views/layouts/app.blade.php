<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sekolah Cinta Kasih Tzu Chi')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/cropped-sck512-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/cropped-sck512-192x192.png" sizes="192x192" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#327041', // Deep Emerald
                            light: '#438e55',
                            dark: '#245230',
                        },
                        secondary: '#F4F4F4', // Soft Gray
                        accent: {
                            DEFAULT: '#D4AF37', // Gold
                            light: '#eac755',
                            dark: '#b39225',
                        },
                        surface: '#ffffff',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.15)',
                        'glow': '0 0 15px rgba(212, 175, 55, 0.3)',
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .glass {
                @apply bg-white/70 backdrop-blur-lg border border-white/20 shadow-glass;
            }
            .glass-dark {
                @apply bg-gray-900/80 backdrop-blur-lg border border-gray-700/30 shadow-glass;
            }
            .text-gradient {
                @apply bg-clip-text text-transparent bg-gradient-to-r from-primary to-primary-light;
            }
            .text-gradient-gold {
                @apply bg-clip-text text-transparent bg-gradient-to-r from-accent to-accent-light;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e0; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a0aec0; 
        }
    </style>
    
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>
<body class="flex flex-col min-h-screen bg-secondary selection:bg-accent selection:text-white">
    @include('sweetalert::alert')

    <!-- Glass Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass" id="navbar">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <img src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2020/12/Main-Logo.png" alt="Logo Tzu Chi" class="h-12 w-auto transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-primary font-medium transition flex items-center py-2">
                            {{ __('Jenjang Pendidikan') }} <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <!-- Dropdown with bridge -->
                        <div class="absolute left-0 top-full pt-2 w-48 hidden group-hover:block hover:block z-50">
                            <div class="bg-white rounded-xl shadow-glass py-2 border border-gray-100">
                                <a href="{{ url('/jenjang/tk') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary">{{ __('TK (Taman Kanak-Kanak)') }}</a>
                                <a href="{{ url('/jenjang/sd') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary">{{ __('SD (Sekolah Dasar)') }}</a>
                                <a href="{{ url('/jenjang/smp') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary">{{ __('SMP (Sekolah Menengah Pertama)') }}</a>
                                <a href="{{ url('/jenjang/smk') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary">{{ __('SMK (Sekolah Menengah Kejuruan)') }}</a>
                            </div>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary font-medium transition relative group">
                                {{ __('Dashboard') }}
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                            </a>
                        @else
                            <a href="{{ route('student.dashboard') }}" class="text-gray-600 hover:text-primary font-medium transition relative group">
                                {{ __('Dashboard') }}
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                            </a>
                        @endif
                        
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-primary focus:outline-none transition py-2">
                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                            </button>
                            <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block hover:block z-50">
                                <div class="bg-white rounded-xl shadow-glass py-2 border border-gray-100">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-red-50 hover:text-red-600 transition">
                                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-primary font-medium transition">{{ __('Pendaftaran') }}</a>
                        <a href="{{ route('login') }}" class="px-6 py-2 rounded-full bg-gradient-to-r from-primary to-primary-light text-white font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-300">
                            {{ __('Login') }}
                        </a>
                    @endauth

                    <!-- Language Switcher -->
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-primary font-medium transition flex items-center py-2">
                            <i class="fas fa-globe mr-1"></i> 
                            @if(app()->getLocale() == 'id') IND
                            @elseif(app()->getLocale() == 'en') ENG
                            @elseif(app()->getLocale() == 'zh') 中文
                            @else IND
                            @endif
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full pt-2 w-32 hidden group-hover:block hover:block z-50">
                            <div class="bg-white rounded-xl shadow-glass py-2 border border-gray-100">
                                <a href="{{ route('lang.switch', 'id') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary {{ app()->getLocale() == 'id' ? 'bg-green-50 text-primary font-bold' : '' }}">
                                    <span class="mr-2">🇮🇩</span> IND
                                </a>
                                <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary {{ app()->getLocale() == 'en' ? 'bg-green-50 text-primary font-bold' : '' }}">
                                    <span class="mr-2">🇺🇸</span> ENG
                                </a>
                                <a href="{{ route('lang.switch', 'zh') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-green-50 hover:text-primary {{ app()->getLocale() == 'zh' ? 'bg-green-50 text-primary font-bold' : '' }}">
                                    <span class="mr-2">🇨🇳</span> 中文
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-600 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
            <div class="px-4 py-2 space-y-1">
                <div class="px-4 py-2 font-bold text-gray-400 text-xs uppercase">Jenjang</div>
                <a href="{{ url('/jenjang/tk') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg pl-6">TK</a>
                <a href="{{ url('/jenjang/sd') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg pl-6">SD</a>
                <a href="{{ url('/jenjang/smp') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg pl-6">SMP</a>
                <a href="{{ url('/jenjang/smk') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg pl-6">SMK</a>
                
                <div class="border-t border-gray-100 my-2"></div>

                @auth
                    <div class="px-4 py-3 border-b border-gray-100 mb-2">
                        <div class="font-bold text-primary">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg">Dashboard</a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg">Dashboard</a>
                        <a href="{{ route('student.biodata') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg">Biodata</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-red-500 hover:bg-red-50 rounded-lg">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-600 hover:bg-green-50 hover:text-primary rounded-lg">{{ __('Pendaftaran') }}</a>
                    <a href="#" class="block px-4 py-2 text-primary font-bold hover:bg-green-50 rounded-lg">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow pt-24 pb-0">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-primary-dark text-white pt-16 pb-8 relative overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2020/12/Main-Logo.png" alt="Logo" class="h-12 bg-white rounded-lg p-1">
                    </div>
                    <p class="text-gray-300 leading-relaxed max-w-md mb-6">
                        Mewujudkan pendidikan yang berbudaya humanis, akademis, dan berbudi pekerti luhur. Membangun generasi masa depan yang cerdas dan penuh kasih.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/cintakasihtzuchi/" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary-dark transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/cintakasihtzuchi/?hl=en" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary-dark transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UCiJzzGJfhL8MyLXvz8YyosA" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-primary-dark transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-accent">{{ __('Kontak Kami') }}</h3>
                    <ul class="space-y-4 text-gray-300">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1.5 mr-3 text-accent"></i>
                            <span>Jl. Kamal Raya Outer Ring Road No. 20, Cengkareng Timur, Jakarta Barat 11730</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-accent"></i>
                            <span>(021) 5596 3680</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp mr-3 text-accent"></i>
                            <span>+62 812 9370 7170</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-accent"></i>
                            <span>info@cintakasihtzuchi.sch.id</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-accent">{{ __('Jenjang Pendidikan') }}</h3>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="{{ url('/jenjang/tk') }}" class="hover:text-accent transition duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> {{ __('TK (Taman Kanak-Kanak)') }}</a></li>
                        <li><a href="{{ url('/jenjang/sd') }}" class="hover:text-accent transition duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> {{ __('SD (Sekolah Dasar)') }}</a></li>
                        <li><a href="{{ url('/jenjang/smp') }}" class="hover:text-accent transition duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> {{ __('SMP (Sekolah Menengah Pertama)') }}</a></li>
                        <li><a href="{{ url('/jenjang/smk') }}" class="hover:text-accent transition duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> {{ __('SMK (Sekolah Menengah Kejuruan)') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Sekolah Cinta Kasih Tzu Chi. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-md');
                navbar.classList.replace('bg-white/70', 'bg-white/95');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.replace('bg-white/95', 'bg-white/70');
            }
        });
    </script>
</body>
</html>
