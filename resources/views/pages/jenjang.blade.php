@extends('layouts.app')

@section('title', $data['name'] . ' - Sekolah Cinta Kasih Tzu Chi')

@section('content')
<!-- Hero Section -->
<div class="relative h-[60vh] min-h-[400px] flex items-center justify-center -mt-24 pt-24 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $data['hero'] }}" alt="{{ $data['name'] }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/30"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in-up">{{ $data['name'] }}</h1>
        <div class="w-24 h-1 bg-accent mx-auto rounded-full mb-6"></div>
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200 leading-relaxed">
            {{ $data['description'] }}
        </p>
    </div>
</div>

<!-- Keunggulan Section -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('Keunggulan Kami') }}</h2>
            <p class="text-gray-500">{{ __('Mengapa memilih') }} {{ $data['name'] }}?</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($data['keunggulan'] as $index => $item)
            <div class="bg-secondary p-8 rounded-2xl border border-gray-100 hover:shadow-glass transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold text-xl mb-6">
                    {{ $index + 1 }}
                </div>
                <h3 class="font-bold text-gray-800 text-lg">{{ $item }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Fasilitas Section -->
@if(!empty($data['facilities']))
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('Fasilitas') }}</h2>
                <div class="w-20 h-1 bg-accent rounded-full"></div>
            </div>
        </div>
        
        <!-- Carousel / Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data['facilities'] as $facility)
            <div class="group relative rounded-2xl overflow-hidden h-64 shadow-md cursor-pointer">
                <img src="{{ $facility }}" alt="Fasilitas" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Activities Section -->
@if(!empty($data['activities']))
<div class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('Kegiatan Siswa') }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($data['activities'] as $activity)
            <div class="rounded-3xl overflow-hidden shadow-soft hover:shadow-lg transition-all duration-300">
                <img src="{{ $activity }}" alt="Kegiatan" class="w-full h-64 object-cover">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- CTA -->
<div class="py-16 bg-primary text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-white mb-6">{{ __('Bergabunglah Bersama Kami') }}</h2>
        <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-accent text-primary-dark font-bold rounded-full shadow-lg hover:bg-white hover:text-primary transition-all duration-300 transform hover:scale-105">
            {{ __('Daftar Sekarang') }}
        </a>
    </div>
</div>
@endsection
