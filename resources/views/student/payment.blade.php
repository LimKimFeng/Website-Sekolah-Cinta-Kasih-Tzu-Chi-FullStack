@extends('layouts.app')

@section('title', 'Upload Pembayaran - Sekolah Cinta Kasih Tzu Chi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-[2.5rem] shadow-glass overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side: Bank Info -->
        <div class="w-full md:w-2/5 bg-gradient-to-br from-blue-600 to-blue-800 p-10 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent opacity-20 rounded-full blur-3xl -ml-10 -mb-10"></div>
            
            <h2 class="text-2xl font-bold mb-8 relative z-10">Instruksi Pembayaran</h2>
            
            <!-- Credit Card Style -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 mb-8 relative z-10 shadow-lg">
                <div class="flex justify-between items-start mb-8">
                    <span class="font-bold tracking-widest text-lg">Blu BCA</span>
                    <i class="fas fa-wifi rotate-90 opacity-70"></i>
                </div>
                <div class="mb-4">
                    <span class="block text-xs opacity-70 mb-1">Nomor Rekening</span>
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xl font-bold tracking-wider">0051 4480 0188</span>
                        <button onclick="navigator.clipboard.writeText('005144800188'); alert('Disalin!');" class="text-white hover:text-accent transition">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <span class="block text-xs opacity-70 mb-1">Atas Nama</span>
                    <span class="font-bold uppercase tracking-wide">Cornelius Nathaniel</span>
                </div>
            </div>

            <div class="relative z-10">
                <h3 class="font-bold mb-4 flex items-center"><i class="fas fa-info-circle mr-2"></i> Petunjuk</h3>
                <ol class="list-decimal list-inside space-y-2 text-sm text-blue-100">
                    <li>Transfer sesuai nominal pendaftaran.</li>
                    <li>Simpan bukti transfer (screenshot/foto).</li>
                    <li>Upload bukti pada form di samping.</li>
                    <li>Tunggu verifikasi admin (1x24 jam).</li>
                </ol>
            </div>
        </div>

        <!-- Right Side: Upload Form -->
        <div class="w-full md:w-3/5 p-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Upload Bukti</h2>
            
            <form action="{{ route('student.payment.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-8">
                    <div class="w-full h-64 border-3 border-dashed border-gray-300 rounded-3xl bg-gray-50 hover:bg-white hover:border-primary transition-all cursor-pointer flex flex-col items-center justify-center group relative overflow-hidden" onclick="document.getElementById('payment_proof').click()">
                        
                        <div id="upload-placeholder" class="text-center p-6 transition-opacity duration-300">
                            <div class="w-16 h-16 bg-white rounded-full shadow-md flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-cloud-upload-alt text-3xl text-primary"></i>
                            </div>
                            <p class="font-bold text-gray-700 mb-1">Klik untuk upload</p>
                            <p class="text-sm text-gray-400">atau drag and drop file disini</p>
                            <p class="text-xs text-gray-400 mt-4">JPG, PNG, PDF (Max 2MB)</p>
                        </div>

                        <img id="preview-img" src="#" class="absolute inset-0 w-full h-full object-cover hidden rounded-3xl" alt="Preview">
                        
                        <input id="payment_proof" name="payment_proof" type="file" class="hidden" accept="image/*" required onchange="previewImage(this)">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-primary-dark transition-all transform hover:-translate-y-1 flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Bukti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('preview-img').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('opacity-0');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
