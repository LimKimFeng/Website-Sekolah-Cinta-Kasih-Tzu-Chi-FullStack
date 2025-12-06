@extends('layouts.app')

@section('title', __('Admin Dashboard') . ' - Sekolah Cinta Kasih Tzu Chi')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ __('Dashboard Admin') }}</h1>
            <p class="text-gray-500 mt-1">{{ __('Kelola data pendaftaran siswa baru.') }}</p>
        </div>
        <div class="bg-white px-6 py-3 rounded-2xl shadow-soft border border-gray-100 flex items-center">
            <div class="w-10 h-10 rounded-full bg-green-100 text-primary flex items-center justify-center mr-3">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <span class="block text-xs text-gray-500 font-bold uppercase">{{ __('Total Pendaftar') }}</span>
                <span class="text-xl font-bold text-gray-800">{{ $candidates->total() }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-glass overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-8 py-6 text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Siswa') }}</th>
                        <th class="px-8 py-6 text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Jenjang') }}</th>
                        <th class="px-8 py-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">{{ __('Status') }}</th>
                        <th class="px-8 py-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">{{ __('Tanggal') }}</th>
                        <th class="px-8 py-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($candidates as $candidate)
                        <tr class="hover:bg-gray-50/50 transition duration-200 group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-light text-white flex items-center justify-center font-bold text-lg shadow-md">
                                        {{ substr($candidate->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $candidate->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $candidate->registration_number }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm font-bold border border-gray-200">
                                    {{ $candidate->level }} {{ $candidate->major ? '('.$candidate->major.')' : '' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
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
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold border {{ $class }} inline-flex items-center">
                                    @if($candidate->status == 'verified' || $candidate->status == 'accepted')
                                        <i class="fas fa-check-circle mr-1.5"></i>
                                    @endif
                                    {{ ucfirst($candidate->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center text-sm text-gray-500">
                                {{ $candidate->created_at->format('d M Y') }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('admin.verify', $candidate->id) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white border border-gray-200 text-gray-400 hover:text-primary hover:border-primary hover:shadow-md transition-all group-hover:scale-110">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 border-t border-gray-100">
            {{ $candidates->links() }}
        </div>
    </div>
</div>
@endsection
