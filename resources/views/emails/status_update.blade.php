<!DOCTYPE html>
<html>
<head>
    <title>Update Status Pendaftaran</title>
</head>
<body>
    <h1>Halo, {{ $candidate->user->name }}</h1>

    @if($candidate->profile && $candidate->profile->profile_picture)
        <div style="margin-bottom: 20px;">
            <img src="{{ $message->embed(storage_path('app/public/' . $candidate->profile->profile_picture)) }}" alt="Foto Profil" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #eee;">
        </div>
    @endif

    @if($candidate->status == 'verified')
        <p>Pembayaran Anda telah DITERIMA.</p>
        <p>Berikut terlampir Kartu Ujian Anda. Silakan cetak dan bawa saat ujian.</p>
        <p>Tanggal Ujian: {{ \Carbon\Carbon::parse($candidate->exam_date)->format('d F Y H:i') }}</p>
    @elseif($candidate->status == 'accepted')
        <p>Selamat! Anda dinyatakan DITERIMA di Sekolah Cinta Kasih Tzu Chi.</p>
        <p>Silakan hubungi sekolah untuk informasi pendaftaran ulang.</p>
    @elseif($candidate->status == 'rejected')
        <p>Mohon maaf, Anda dinyatakan TIDAK DITERIMA.</p>
        <p>Tetap semangat dan jangan menyerah.</p>
    @else
        <p>Status pendaftaran Anda telah diperbarui menjadi: {{ ucfirst($candidate->status) }}</p>
    @endif

    <p>Terima kasih.</p>
</body>
</html>
