@extends('layouts.app')

@section('title', __('Dashboard Siswa'))

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-r from-primary to-primary-light rounded-3xl p-8 md:p-12 mb-12 text-white overflow-hidden shadow-glass">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent opacity-20 rounded-full blur-3xl -ml-10 -mb-10"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-6 md:mb-0">
                <div class="w-20 h-20 rounded-full border-4 border-white/30 shadow-lg overflow-hidden mr-6 bg-white/10 backdrop-blur-sm flex-shrink-0">
                    @if(isset($candidate->profile->profile_picture))
                        <img src="{{ asset('storage/' . $candidate->profile->profile_picture) }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ __('Halo') }}, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-green-100 text-lg">{{ __('Selamat datang di portal PPDB Sekolah Cinta Kasih Tzu Chi.') }}</p>
                </div>
            </div>
            <div class="bg-white/20 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/30">
                <span class="block text-xs text-green-100 uppercase tracking-wider font-bold">{{ __('Nomor Registrasi') }}</span>
                <span class="text-2xl font-mono font-bold">{{ $candidate->registration_number }}</span>
            </div>
        </div>
    </div>

    <!-- Status Timeline -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">{{ __('Status Pendaftaran') }}</h2>
        <div class="relative">
            <!-- Connecting Line -->
            <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 -translate-y-1/2 hidden md:block rounded-full"></div>
            <div class="absolute top-1/2 left-0 h-1 bg-primary -translate-y-1/2 hidden md:block rounded-full transition-all duration-1000" style="width: {{ $candidate->status == 'draft' ? '15%' : ($candidate->status == 'submitted' ? '50%' : '100%') }}"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-soft border border-gray-100 relative group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mb-4 {{ $candidate->status != 'draft' ? 'bg-green-100 text-primary' : 'bg-primary text-white shadow-glow' }}">
                        @if($candidate->status != 'draft') <i class="fas fa-check"></i> @else 1 @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('Lengkapi Biodata') }}</h3>
                    <p class="text-gray-500 text-sm">{{ __('Isi data diri, orang tua, dan sekolah asal secara lengkap.') }}</p>
                    @if($candidate->status == 'draft')
                        <span class="absolute top-6 right-6 w-3 h-3 bg-accent rounded-full animate-ping"></span>
                    @endif
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-soft border border-gray-100 relative group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mb-4 {{ ($candidate->status == 'verified' || $candidate->status == 'accepted' || $candidate->status == 'rejected') ? 'bg-green-100 text-primary' : ($candidate->status == 'submitted' ? 'bg-primary text-white shadow-glow' : 'bg-gray-100 text-gray-400') }}">
                        @if($candidate->status == 'verified' || $candidate->status == 'accepted' || $candidate->status == 'rejected') <i class="fas fa-check"></i> @else 2 @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('Verifikasi & Pembayaran') }}</h3>
                    <p class="text-gray-500 text-sm">{{ __('Admin memverifikasi data dan bukti pembayaran Anda.') }}</p>
                    @if($candidate->status == 'submitted')
                        <span class="absolute top-6 right-6 w-3 h-3 bg-blue-400 rounded-full animate-ping"></span>
                    @endif
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-soft border border-gray-100 relative group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mb-4 {{ ($candidate->status == 'accepted' || $candidate->status == 'rejected') ? 'bg-green-100 text-primary' : 'bg-gray-100 text-gray-400' }}">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('Pengumuman') }}</h3>
                    <p class="text-gray-500 text-sm">{{ __('Hasil seleksi penerimaan peserta didik baru.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Main Action -->
        <div class="bg-white rounded-3xl p-8 shadow-glass border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-bolt text-accent mr-3"></i> {{ __('Aksi Diperlukan') }}
            </h3>

            @if($candidate->status == 'draft')
                <div class="bg-yellow-50 rounded-2xl p-6 border border-yellow-100 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-yellow-600 mt-1 mr-3 text-lg"></i>
                        <div>
                            <h4 class="font-bold text-yellow-800">{{ __('Biodata Belum Lengkap') }}</h4>
                            <p class="text-yellow-700 text-sm mt-1">{{ __('Anda belum menyelesaikan pengisian biodata. Silakan lengkapi untuk melanjutkan ke tahap pembayaran.') }}</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('student.biodata') }}" class="w-full block text-center bg-primary text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    {{ __('Lengkapi Biodata Sekarang') }} <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @elseif($candidate->status == 'submitted')
                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 mt-1 mr-3 text-lg"></i>
                        <div>
                            <h4 class="font-bold text-blue-800">{{ __('Menunggu Verifikasi') }}</h4>
                            <p class="text-blue-700 text-sm mt-1">{{ __('Data Anda sedang diperiksa. Pastikan Anda sudah mengupload bukti pembayaran.') }}</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('student.payment') }}" class="w-full block text-center bg-accent text-primary-dark font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-upload mr-2"></i> {{ __('Upload Bukti Pembayaran') }}
                </a>
            @elseif($candidate->status == 'verified')
                <div class="bg-green-50 rounded-2xl p-6 border border-green-100 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 mt-1 mr-3 text-lg"></i>
                        <div>
                            <h4 class="font-bold text-green-800">{{ __('Pembayaran Terverifikasi') }}</h4>
                            <p class="text-green-700 text-sm mt-1">{{ __('Terima kasih. Kartu ujian telah dikirim ke email Anda.') }}</p>
                            <div class="mt-4 p-4 bg-white rounded-xl border border-green-200">
                                <p class="text-xs text-gray-500 uppercase font-bold">{{ __('Jadwal Ujian') }}</p>
                                <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($candidate->exam_date)->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($candidate->status == 'accepted')
                <div class="text-center py-8">
                    <div class="w-24 h-24 bg-accent rounded-full flex items-center justify-center mx-auto mb-6 shadow-glow animate-bounce">
                        <i class="fas fa-graduation-cap text-white text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-primary mb-2">{{ __('Selamat! Anda Diterima') }}</h2>
                    <p class="text-gray-600">{{ __('Selamat bergabung di Sekolah Cinta Kasih Tzu Chi.') }}</p>
                </div>
            @endif
        </div>

        <!-- Information Card -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-8 shadow-glass text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full blur-3xl -mr-10 -mt-10"></div>
            
            <h3 class="text-xl font-bold mb-6 flex items-center relative z-10">
                <i class="fas fa-bullhorn text-accent mr-3"></i> {{ __('Informasi Penting') }}
            </h3>
            
            <ul class="space-y-4 relative z-10">
                <li class="flex items-start bg-white/5 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                    <i class="fas fa-calendar-alt text-accent mt-1 mr-3"></i>
                    <div>
                        <span class="block font-bold text-sm text-gray-300">{{ __('Batas Akhir Pendaftaran') }}</span>
                        <span class="text-white">30 Desember 2025</span>
                    </div>
                </li>
                <li class="flex items-start bg-white/5 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                    <i class="fas fa-phone-alt text-accent mt-1 mr-3"></i>
                    <div>
                        <span class="block font-bold text-sm text-gray-300">{{ __('Layanan Bantuan') }}</span>
                        <span class="text-white">(021) 5596 3680</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
