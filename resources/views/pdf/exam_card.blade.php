<!DOCTYPE html>
<html>
<head>
    <title>Kartu Ujian</title>
    <style>
        body { font-family: sans-serif; }
        .card { border: 2px solid #327041; padding: 20px; width: 100%; max-width: 600px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #327041; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #327041; margin: 0; }
        .content { margin-bottom: 20px; }
        .row { margin-bottom: 10px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .footer { text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1>KARTU UJIAN</h1>
            <p>Sekolah Cinta Kasih Tzu Chi</p>
        </div>
        
        <div class="content">
            <div class="row">
                <span class="label">No. Registrasi:</span> {{ $candidate->registration_number }}
            </div>
            <div class="row">
                <span class="label">Nama Peserta:</span> {{ $candidate->user->name }}
            </div>
            <div class="row">
                <span class="label">Jenjang:</span> {{ $candidate->level }} {{ $candidate->major ? '('.$candidate->major.')' : '' }}
            </div>
            <div class="row">
                <span class="label">Tanggal Ujian:</span> {{ \Carbon\Carbon::parse($candidate->exam_date)->format('d F Y H:i') }}
            </div>
            <div class="row">
                <span class="label">Lokasi:</span> Gedung Sekolah Cinta Kasih Tzu Chi
            </div>
        </div>

        <div class="footer">
            <p>Harap membawa kartu ini saat pelaksanaan ujian.</p>
            <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
