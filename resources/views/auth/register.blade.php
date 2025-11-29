@extends('layouts.app')

@section('title', 'Pendaftaran - Sekolah Cinta Kasih Tzu Chi')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 -mt-20">
    <div class="max-w-6xl w-full bg-white rounded-[2rem] shadow-glass overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side: Image & Quote -->
        <div class="hidden md:flex md:w-1/2 bg-primary relative flex-col justify-between p-12 text-white overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-dark to-primary opacity-90 z-0"></div>
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center mix-blend-overlay opacity-40 z-0"></div>
            
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-quote-left text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold leading-tight mb-6">"Pendidikan adalah bekal terbaik untuk perjalanan hidup."</h2>
                <p class="text-green-100 text-lg">Bergabunglah dengan komunitas pembelajar yang berdedikasi untuk keunggulan dan kasih sayang.</p>
            </div>

            <div class="relative z-10">
                <div class="flex items-center space-x-4">
                    <div class="flex -space-x-2">
                        <img class="w-10 h-10 rounded-full border-2 border-primary" src="https://i.pravatar.cc/100?img=1" alt="Student">
                        <img class="w-10 h-10 rounded-full border-2 border-primary" src="https://i.pravatar.cc/100?img=2" alt="Student">
                        <img class="w-10 h-10 rounded-full border-2 border-primary" src="https://i.pravatar.cc/100?img=3" alt="Student">
                    </div>
                    <p class="text-sm font-medium text-green-100">Bergabung dengan 500+ siswa lainnya</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full md:w-1/2 p-8 md:p-12 bg-white relative">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
                <p class="text-gray-500 mt-2">Silakan lengkapi data diri Anda untuk mendaftar.</p>
            </div>

            <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="text" name="b_field" class="hidden" autocomplete="off">

                <div class="space-y-5">
                    <div class="relative group">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="peer w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all placeholder-transparent" placeholder="Nama Lengkap" required>
                        <label for="name" class="absolute left-4 -top-2.5 bg-white px-1 text-sm text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-gray-400 peer-focus:-top-2.5 peer-focus:text-primary peer-focus:font-semibold">Nama Lengkap</label>
                    </div>

                    <div class="relative group">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="peer w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all placeholder-transparent" placeholder="Email" required>
                        <label for="email" class="absolute left-4 -top-2.5 bg-white px-1 text-sm text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-gray-400 peer-focus:-top-2.5 peer-focus:text-primary peer-focus:font-semibold">Email</label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="relative group">
                            <input type="password" name="password" id="password" class="peer w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all placeholder-transparent" placeholder="Password" required>
                            <label for="password" class="absolute left-4 -top-2.5 bg-white px-1 text-sm text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-gray-400 peer-focus:-top-2.5 peer-focus:text-primary peer-focus:font-semibold">Password</label>
                        </div>
                        <div class="relative group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="peer w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all placeholder-transparent" placeholder="Konfirmasi" required>
                            <label for="password_confirmation" class="absolute left-4 -top-2.5 bg-white px-1 text-sm text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-gray-400 peer-focus:-top-2.5 peer-focus:text-primary peer-focus:font-semibold">Konfirmasi</label>
                        </div>
                    </div>

                    <div class="relative group">
                        <select name="level" id="level" class="peer w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all appearance-none" required onchange="toggleMajor()">
                            <option value="" disabled selected>Pilih Jenjang Pendidikan</option>
                            <option value="TK" {{ old('level') == 'TK' ? 'selected' : '' }}>TK</option>
                            <option value="SD" {{ old('level') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('level') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ old('level') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="SMK" {{ old('level') == 'SMK' ? 'selected' : '' }}>SMK</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <label for="level" class="absolute left-4 -top-2.5 bg-white px-1 text-sm text-primary font-semibold">Jenjang</label>
                    </div>

                    <div class="hidden animate-fade-in-up" id="major-container">
                        <div class="relative group">
                            <select name="major" id="major" class="peer w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 text-gray-900 focus:outline-none focus:border-primary focus:bg-white transition-all appearance-none">
                                <option value="" disabled selected>Pilih Jurusan</option>
                                <option value="PPLG" {{ old('major') == 'PPLG' ? 'selected' : '' }}>PPLG (Pengembangan Perangkat Lunak & Gim)</option>
                                <option value="AKL" {{ old('major') == 'AKL' ? 'selected' : '' }}>AKL (Akuntansi)</option>
                                <option value="MPLB" {{ old('major') == 'MPLB' ? 'selected' : '' }}>MPLB (Manajemen Perkantoran)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                            <label for="major" class="absolute left-4 -top-2.5 bg-white px-1 text-sm text-primary font-semibold">Jurusan</label>
                        </div>
                    </div>
                </div>

                <!-- Premium Slide to Verify -->
                <div class="relative w-full h-14 bg-gray-100 rounded-full overflow-hidden shadow-inner flex items-center p-1 cursor-pointer select-none group" id="slider-container">
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <span class="text-gray-400 font-semibold tracking-wide group-hover:text-gray-500 transition-colors" id="slider-text">Geser ke kanan untuk verifikasi</span>
                    </div>
                    <div class="h-12 w-12 bg-white rounded-full shadow-md flex items-center justify-center text-primary relative z-10 cursor-grab active:cursor-grabbing transition-transform" id="slider-handle">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="absolute inset-y-0 left-0 bg-green-100 w-0 z-0 transition-all" id="slider-track"></div>
                    <input type="hidden" name="is_human_verified" id="is_human_verified" value="false">
                </div>

                <!-- Turnstile -->
                <div class="flex justify-center">
                    <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
                </div>

                <button type="submit" id="submit-btn" class="w-full py-4 rounded-xl font-bold text-white bg-gray-300 cursor-not-allowed shadow-none transition-all duration-300 transform" disabled>
                    Daftar Sekarang
                </button>

                <p class="text-center text-gray-500 text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk disini</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleMajor() {
        const level = document.getElementById('level').value;
        const majorContainer = document.getElementById('major-container');
        if (level === 'SMK') {
            majorContainer.classList.remove('hidden');
        } else {
            majorContainer.classList.add('hidden');
        }
    }

    // Physics-like Slider Logic
    const sliderContainer = document.getElementById('slider-container');
    const sliderHandle = document.getElementById('slider-handle');
    const sliderTrack = document.getElementById('slider-track');
    const sliderText = document.getElementById('slider-text');
    const submitBtn = document.getElementById('submit-btn');
    const isHumanInput = document.getElementById('is_human_verified');
    
    let isDragging = false;
    let startX = 0;
    const maxDrag = sliderContainer.offsetWidth - sliderHandle.offsetWidth - 8; // 8px padding

    sliderHandle.addEventListener('mousedown', startDrag);
    sliderHandle.addEventListener('touchstart', startDrag);

    document.addEventListener('mousemove', drag);
    document.addEventListener('touchmove', drag);

    document.addEventListener('mouseup', endDrag);
    document.addEventListener('touchend', endDrag);

    function startDrag(e) {
        if (isHumanInput.value === 'true') return;
        isDragging = true;
        startX = (e.type === 'mousedown' ? e.clientX : e.touches[0].clientX) - sliderHandle.offsetLeft;
        sliderHandle.style.transition = 'none';
        sliderTrack.style.transition = 'none';
    }

    function drag(e) {
        if (!isDragging) return;
        e.preventDefault();
        
        const clientX = e.type === 'mousemove' ? e.clientX : e.touches[0].clientX;
        let x = clientX - startX;

        if (x < 0) x = 0;
        if (x > maxDrag) x = maxDrag;

        sliderHandle.style.transform = `translateX(${x}px)`;
        sliderTrack.style.width = `${x + 24}px`; // +24 to cover the handle center

        // Opacity effect
        const opacity = 1 - (x / maxDrag);
        sliderText.style.opacity = opacity;
    }

    function endDrag() {
        if (!isDragging) return;
        isDragging = false;
        
        const currentX = parseFloat(sliderHandle.style.transform.replace('translateX(', '').replace('px)', '')) || 0;

        if (currentX >= maxDrag - 10) {
            // Verified
            sliderHandle.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            sliderHandle.style.transform = `translateX(${maxDrag}px)`;
            sliderTrack.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            sliderTrack.style.width = '100%';
            sliderTrack.classList.remove('bg-green-100');
            sliderTrack.classList.add('bg-primary');
            
            sliderHandle.innerHTML = '<i class="fas fa-check text-primary"></i>';
            sliderText.textContent = "Terverifikasi";
            sliderText.style.opacity = 1;
            sliderText.classList.add('text-white', 'font-bold', 'z-20');
            sliderText.classList.remove('text-gray-400', 'group-hover:text-gray-500');
            
            isHumanInput.value = 'true';
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-300', 'cursor-not-allowed', 'shadow-none');
            submitBtn.classList.add('bg-gradient-to-r', 'from-primary', 'to-primary-light', 'hover:shadow-lg', 'hover:-translate-y-1', 'cursor-pointer');
        } else {
            // Reset
            sliderHandle.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            sliderHandle.style.transform = 'translateX(0px)';
            sliderTrack.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            sliderTrack.style.width = '0px';
            sliderText.style.opacity = 1;
        }
    }
    
    window.addEventListener('resize', () => {
         if(isHumanInput.value !== 'true') {
             sliderHandle.style.transform = 'translateX(0px)';
             sliderTrack.style.width = '0px';
         }
    });
</script>
@endsection
