@extends('layouts.app')

@section('title', __('Isi Biodata') . ' - Sekolah Cinta Kasih Tzu Chi')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-[2.5rem] shadow-glass overflow-hidden">
        <!-- Header -->
        <div class="bg-primary px-10 py-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-2">{{ __('Formulir Biodata Siswa') }}</h2>
                <p class="text-green-100">{{ __('Mohon lengkapi data di bawah ini dengan benar untuk keperluan administrasi.') }}</p>
            </div>
        </div>

        <form action="{{ route('student.biodata.update') }}" method="POST" class="p-8 md:p-12" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-bold">
                                {{ __('Terdapat kesalahan pada pengisian form:') }}
                            </p>
                            <ul class="mt-1 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Section 1: Personal Data -->
            <div class="mb-12">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-primary flex items-center justify-center font-bold text-lg mr-4">1</div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ __('Data Pribadi') }}</h3>
                </div>

                <!-- Profile Picture Section -->
                <div class="mb-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative group">
                            <div class="w-40 h-40 bg-gray-200 rounded-xl overflow-hidden border-4 border-white shadow-lg relative">
                                @if(isset($profile->profile_picture))
                                    <img id="profile-preview" src="{{ asset('storage/' . $profile->profile_picture) }}" class="w-full h-full object-cover">
                                @else
                                    <img id="profile-preview" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('profile_picture').click()">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </div>
                            </div>
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*" onchange="previewProfile(this)">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-lg text-gray-800 mb-2">{{ __('Foto Profil Profesional') }}</h4>
                            <div class="bg-white p-4 rounded-xl border border-blue-100 shadow-sm">
                                <p class="text-sm text-gray-600 mb-2 font-bold"><i class="fas fa-info-circle text-blue-500 mr-2"></i> {{ __('Ketentuan Foto:') }}</p>
                                <ul class="list-disc list-inside text-sm text-gray-500 space-y-1 ml-1">
                                    <li>{{ __('Wajah terlihat jelas dan menghadap ke depan.') }}</li>
                                    <li>{{ __('Pakaian rapi dan sopan (kemeja/seragam).') }}</li>
                                    <li>{{ __('Latar belakang polos (disarankan merah/biru).') }}</li>
                                    <li>{{ __('Format: JPG, PNG (Max 2MB).') }}</li>
                                </ul>
                            </div>
                            <button type="button" onclick="document.getElementById('profile_picture').click()" class="mt-4 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                                <i class="fas fa-upload mr-2"></i> {{ __('Pilih Foto') }}
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">NISN</label>
                        <input type="text" name="nisn" value="{{ old('nisn', $profile->nisn ?? '') }}" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" placeholder="{{ __('Nomor Induk Siswa Nasional') }}" required>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Jenis Kelamin') }}</label>
                        <div class="relative">
                            <select name="gender" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none appearance-none" required>
                                <option value="">{{ __('Pilih Jenis Kelamin') }}</option>
                                <option value="L" {{ (old('gender', $profile->gender ?? '') == 'L') ? 'selected' : '' }}>{{ __('Laki-laki') }}</option>
                                <option value="P" {{ (old('gender', $profile->gender ?? '') == 'P') ? 'selected' : '' }}>{{ __('Perempuan') }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Tempat Lahir') }}</label>
                        <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $profile->place_of_birth ?? '') }}" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" placeholder="{{ __('Kota Kelahiran') }}" required>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Tanggal Lahir') }}</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" required>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Agama') }}</label>
                        <div class="relative">
                            <select name="religion" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none appearance-none" required>
                                <option value="">{{ __('Pilih Agama') }}</option>
                                <option value="Buddha" {{ (old('religion', $profile->religion ?? '') == 'Buddha') ? 'selected' : '' }}>Buddha</option>
                                <option value="Islam" {{ (old('religion', $profile->religion ?? '') == 'Islam') ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ (old('religion', $profile->religion ?? '') == 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ (old('religion', $profile->religion ?? '') == 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ (old('religion', $profile->religion ?? '') == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                <option value="Konghucu" {{ (old('religion', $profile->religion ?? '') == 'Konghucu') ? 'selected' : '' }}>Konghucu</option>
                                <option value="Lainnya" {{ (old('religion', $profile->religion ?? '') == 'Lainnya') ? 'selected' : '' }}>{{ __('Lainnya') }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('No. Telepon / WhatsApp') }}</label>
                        <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="col-span-1 md:col-span-2 group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Alamat Lengkap') }}</label>
                        <textarea name="address" rows="3" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" placeholder="{{ __('Jalan, RT/RW, Kelurahan, Kecamatan') }}" required>{{ old('address', $profile->address ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Parents Data -->
            <div class="mb-12">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-primary flex items-center justify-center font-bold text-lg mr-4">2</div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ __('Data Orang Tua') }}</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Nama Ayah') }}</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $profile->father_name ?? '') }}" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" required>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-primary transition-colors">{{ __('Nama Ibu') }}</label>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $profile->mother_name ?? '') }}" class="w-full px-5 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none" required>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pt-8 border-t border-gray-100">
                <a href="{{ route('student.dashboard') }}" class="px-6 py-3 text-gray-500 hover:text-gray-700 font-bold mr-4 transition">{{ __('Batal') }}</a>
                <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-primary-dark transition-all transform hover:-translate-y-1">
                    {{ __('Simpan Biodata') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    function previewProfile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
