@extends('layouts.app')

@section('title', 'Sekolah Cinta Kasih Tzu Chi - Pendidikan Berbudaya Humanis')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden -mt-24 pt-24">
    <!-- Background Video/Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/08/IMG_8503-scaled.jpg" alt="Background" class="w-full h-full object-cover opacity-20 scale-105 animate-pulse-slow">
        <div class="absolute inset-0 bg-gradient-to-br from-white via-white/80 to-green-50/50"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <div class="animate-fade-in-up">
            <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-primary font-bold text-sm mb-6 tracking-wider uppercase">Penerimaan Peserta Didik Baru 2025/2026</span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 mb-6 leading-tight tracking-tight">
                Pendidikan Berbudaya <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-light">Humanis</span>
            </h1>
            <p class="text-xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                "Terwujudnya pendidikan manusia yang seutuhnya yang berlandaskan pada nilai kemanusiaan dan menekankan perkembangan yang seimbang antara intelektual, kebajikan, kearifan, kebersamaan dan keindahan."
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-primary text-white font-bold rounded-full shadow-lg hover:shadow-green-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        Daftar Sekarang <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-light to-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="https://youtu.be/6Qf_Que4QfI" target="_blank" class="px-8 py-4 bg-white text-gray-700 font-bold rounded-full shadow-soft hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100 flex items-center">
                    <i class="fas fa-play-circle text-accent mr-2 text-xl"></i> Tonton Profil Sekolah
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Vision & Mission Section -->
<div class="py-20 bg-white relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-accent/20 rounded-full blur-3xl"></div>
                <img src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/19.-Marcella-Winata-scaled.jpg" alt="Vision" class="rounded-[2rem] shadow-glass relative z-10 transform hover:scale-105 transition duration-500">
            </div>
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Visi & Misi Kami</h2>
                <div class="space-y-6">
                    <div class="bg-secondary p-6 rounded-2xl border-l-4 border-primary">
                        <h3 class="font-bold text-xl text-primary mb-2">Visi</h3>
                        <p class="text-gray-600 italic">"Terwujudnya pendidikan manusia yang seutuhnya yang berlandaskan pada nilai kemanusiaan dan menekankan perkembangan yang seimbang antara intelektual, kebajikan, kearifan, kebersamaan dan keindahan."</p>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                            <span class="text-gray-700">Menebarkan cinta kasih universal.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                            <span class="text-gray-700">Membina peserta didik yang unggul, tekun, dan demokratis.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                            <span class="text-gray-700">Menyiapkan pendidikan berkarakter percaya diri dan sabar.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jenjang Pendidikan Section -->
<div class="py-24 bg-secondary relative">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Jenjang Pendidikan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan pendidikan berkualitas dari tingkat TK hingga SMK dengan fasilitas lengkap dan kurikulum berstandar.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($jenjangs as $key => $jenjang)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-soft hover:shadow-glass transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ $jenjang['hero'] }}" alt="{{ $jenjang['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <span class="text-white font-bold text-sm">Lihat Detail <i class="fas fa-arrow-right ml-1"></i></span>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $jenjang['name'] }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">{{ $jenjang['description'] }}</p>
                    <a href="{{ url('/jenjang/'.$key) }}" class="inline-block w-full text-center py-2 rounded-xl bg-gray-50 text-primary font-bold hover:bg-primary hover:text-white transition-colors">
                        Selengkapnya
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- News Section -->
<div class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Berita & Kegiatan</h2>
                <div class="w-20 h-1 bg-accent rounded-full"></div>
            </div>
            <a href="#" class="hidden md:flex items-center text-primary font-bold hover:text-primary-dark transition">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($news as $item)
            <article class="group cursor-pointer">
                <div class="rounded-2xl overflow-hidden mb-4 relative h-56">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-primary shadow-sm">
                        {{ $item['category'] }}
                    </div>
                </div>
                <div class="flex items-center text-xs text-gray-400 mb-2">
                    <i class="far fa-calendar-alt mr-2"></i> {{ $item['date'] }}
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                    {{ $item['title'] }}
                </h3>
            </article>
            @endforeach
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-24 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-bold text-white mb-8">Siap Bergabung Bersama Kami?</h2>
        <p class="text-green-100 text-lg mb-10 max-w-2xl mx-auto">
            Pendaftaran Tahun Ajaran 2025/2026 telah dibuka. Segera daftarkan putra-putri Anda dan jadilah bagian dari keluarga besar Tzu Chi.
        </p>
        <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-accent text-primary-dark font-bold rounded-full shadow-lg hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
            Daftar Sekarang
        </a>
    </div>
</div>
@endsection
