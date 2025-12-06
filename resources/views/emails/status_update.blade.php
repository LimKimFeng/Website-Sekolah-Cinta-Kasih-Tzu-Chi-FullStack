<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Update Status Pendaftaran') }}</title>
</head>
<body>
    <h1>{{ __('Halo') }}, {{ $candidate->user->name }}</h1>

    @if($candidate->profile && $candidate->profile->profile_picture)
        <div style="margin-bottom: 20px;">
            <img src="{{ $message->embed(storage_path('app/public/' . $candidate->profile->profile_picture)) }}" alt="{{ __('Foto Profil') }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #eee;">
        </div>
    @endif

    @if($candidate->status == 'verified')
        <p>{{ __('Pembayaran Anda telah DITERIMA.') }}</p>
        <p>{{ __('Berikut terlampir Kartu Ujian Anda. Silakan cetak dan bawa saat ujian.') }}</p>
        <p>{{ __('Tanggal Ujian') }}: {{ \Carbon\Carbon::parse($candidate->exam_date)->format('d F Y H:i') }}</p>
    @elseif($candidate->status == 'accepted')
        <p>{{ __('Selamat! Anda dinyatakan DITERIMA di Sekolah Cinta Kasih Tzu Chi.') }}</p>
        <p>{{ __('Silakan hubungi sekolah untuk informasi pendaftaran ulang.') }}</p>
    @elseif($candidate->status == 'rejected')
        <p>{{ __('Mohon maaf, Anda dinyatakan TIDAK DITERIMA.') }}</p>
        <p>{{ __('Tetap semangat dan jangan menyerah.') }}</p>
    @else
        <p>{{ __('Status pendaftaran Anda telah diperbarui menjadi:') }} {{ ucfirst($candidate->status) }}</p>
    @endif

    <p>{{ __('Terima kasih.') }}</p>
</body>
</html>
