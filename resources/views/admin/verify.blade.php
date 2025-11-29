@extends('layouts.app')

@section('title', 'Verifikasi Siswa - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center text-gray-500 hover:text-primary transition">
            <div class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center mr-3 shadow-sm group-hover:shadow-md group-hover:border-primary transition-all">
                <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
            </div>
            <span class="font-bold">Kembali ke Dashboard</span>
        </a>
        
        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-500 font-bold uppercase tracking-wider">Status Saat Ini:</span>
            @php
                $statusClasses = [
                    'draft' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                    'submitted' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'verified' => 'bg-green-100 text-green-700 border-green-200',
                    'accepted' => 'bg-green-100 text-green-700 border-green-200',
                    'rejected' => 'bg-red-100 text-red-700 border-red-200',
                ];
                $class = $statusClasses[$candidate->status] ?? 'bg-gray-100 text-gray-600';
            @endphp
            <span class="px-4 py-2 rounded-full text-sm font-bold border {{ $class }} flex items-center shadow-sm">
                @if($candidate->status == 'verified' || $candidate->status == 'accepted')
                    <i class="fas fa-check-circle mr-2"></i>
                @endif
                {{ ucfirst($candidate->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Student Data -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Header Card -->
            <div class="bg-white rounded-[2rem] p-8 shadow-glass border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary opacity-5 rounded-full blur-3xl -mr-16 -mt-16"></div>
                
                <div class="flex items-start justify-between relative z-10">
                    <div class="flex items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center font-bold text-3xl shadow-lg shadow-green-200">
                            {{ substr($candidate->user->name, 0, 1) }}
                        </div>
                        <div class="ml-6">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $candidate->user->name }}</h1>
                            <div class="flex items-center mt-2 text-gray-500">
                                <i class="far fa-envelope mr-2"></i> {{ $candidate->user->email }}
                            </div>
                            <div class="flex items-center mt-1 text-primary font-bold">
                                <i class="fas fa-id-card mr-2"></i> {{ $candidate->registration_number }}
                            </div>
                        </div>
                    </div>
                    <div class="text-right hidden sm:block">
                        <div class="text-sm text-gray-500 mb-1">Jenjang Pendidikan</div>
                        <div class="text-xl font-bold text-gray-900">{{ $candidate->level }}</div>
                        @if($candidate->major)
                            <div class="text-sm font-bold text-accent bg-yellow-50 px-2 py-1 rounded-lg inline-block mt-1 border border-yellow-100">
                                {{ $candidate->major }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Biodata Card -->
            <div class="bg-white rounded-[2rem] p-8 shadow-glass border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-3 text-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    Biodata Lengkap
                </h3>

                @if($candidate->profile)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">NISN</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->nisn }}</div>
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jenis Kelamin</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->place_of_birth }}, {{ $candidate->profile->date_of_birth }}</div>
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Agama</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->religion }}</div>
                        </div>
                        <div class="group md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->address }}</div>
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Ayah</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->father_name }}</div>
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Ibu</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->mother_name }}</div>
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">No. Telepon</label>
                            <div class="font-semibold text-gray-900 text-lg">{{ $candidate->profile->phone }}</div>
                        </div>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-100 rounded-xl p-6 text-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3 text-red-500">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="font-bold text-red-800">Biodata Belum Lengkap</p>
                        <p class="text-red-600 text-sm">Siswa belum mengisi formulir biodata.</p>
                    </div>
                @endif
            </div>

            <!-- Documents Card -->
            <div class="bg-white rounded-[2rem] p-8 shadow-glass border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mr-3 text-sm">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    Dokumen Pendukung
                </h3>

                @if($candidate->documents->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($candidate->documents as $doc)
                            <div class="group relative rounded-2xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300">
                                <div class="aspect-[4/3] bg-gray-100 relative">
                                    @if(in_array(pathinfo($doc->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('storage/' . $doc->file_path) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <i class="fas fa-file-pdf text-4xl"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-900 hover:bg-primary hover:text-white transition-colors transform hover:scale-110">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-3 bg-white border-t border-gray-100">
                                    <p class="text-xs font-bold text-gray-700 uppercase truncate text-center">{{ str_replace('_', ' ', $doc->file_type) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50">
                        <i class="fas fa-folder-open text-3xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 font-medium">Belum ada dokumen yang diupload.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Action Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2rem] shadow-glass border border-gray-100 sticky top-28 overflow-hidden">
                <div class="bg-gray-900 p-6 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary opacity-20 rounded-full blur-3xl -mr-10 -mt-10"></div>
                    <h3 class="text-lg font-bold relative z-10 flex items-center">
                        <i class="fas fa-cog mr-2 text-accent"></i> Panel Verifikasi
                    </h3>
                </div>
                
                <form action="{{ route('admin.updateStatus', $candidate->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Update Status</label>
                        <div class="relative">
                            <select name="status" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none appearance-none font-medium text-gray-800">
                                <option value="draft" {{ $candidate->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="submitted" {{ $candidate->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                <option value="verified" {{ $candidate->status == 'verified' ? 'selected' : '' }}>Verified (Pembayaran OK)</option>
                                <option value="accepted" {{ $candidate->status == 'accepted' ? 'selected' : '' }}>Accepted (Diterima)</option>
                                <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal</label>
                                <input type="date" name="exam_date_date" value="{{ $candidate->exam_date ? $candidate->exam_date->format('Y-m-d') : '' }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none font-medium text-gray-800">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jam</label>
                                <input type="time" name="exam_date_time" value="{{ $candidate->exam_date ? $candidate->exam_date->format('H:i') : '' }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-100 focus:border-primary focus:bg-white focus:ring-0 transition-all outline-none font-medium text-gray-800">
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i> Wajib diisi jika status <strong>Verified</strong>
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-primary-dark transition-all transform hover:-translate-y-1 flex justify-center items-center group">
                            <span class="mr-2">Simpan & Kirim Notifikasi</span>
                            <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
