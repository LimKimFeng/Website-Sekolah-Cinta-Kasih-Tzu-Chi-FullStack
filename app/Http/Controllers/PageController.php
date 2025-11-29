<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private $jenjangData = [
        'tk' => [
            'name' => 'TK Cinta Kasih Tzu Chi',
            'slug' => 'tk',
            'description' => 'Program Sekolah Anak Usia Dini berfungsi sebagai landasan pembelajaran seumur hidup. Tujuan kami adalah menumbuhkan individu yang bahagia, cakap, dan berkarakter mulia.',
            'keunggulan' => [
                'Pendidikan Karakter Berbasis Nilai Kemanusiaan.',
                'Lingkungan Sekolah Aman & Nyaman.',
                'Metode Pembelajaran Holistik.',
                'Pengajaran Dua Bahasa (Indonesia & Mandarin).'
            ],
            'hero' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/08/IMG_8503-scaled.jpg',
            'facilities' => [
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/Ruang-Taman-Bermain-Anak-anak-TK-1-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/Ruang-Budaya-Humanis-KB-TK-2-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/Ruang-Budaya-Humanis-TK-KB-1-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/Ruang-Komputer-KB-TK-3-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/03/Ruang-Kelas-KB-TK-1-scaled.jpg'
            ],
            'activities' => [
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/Field-Trip.jpeg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/Cooking-Class.jpeg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/Saji-Teh-rotated.jpg'
            ]
        ],
        'sd' => [
            'name' => 'SD Cinta Kasih Tzu Chi',
            'slug' => 'sd',
            'description' => 'Landasan penting pembentukan karakter dan pembelajaran seumur hidup. Pendekatan disesuaikan dengan kecepatan belajar masing-masing untuk menumbuhkan kecakapan akademis dan nilai karakter mulia.',
            'keunggulan' => [
                'Pendidikan Karakter & Budi Pekerti.',
                'Kurikulum Holistik & Inovatif.',
                'Bilingual (Indonesia & Mandarin).',
                'Penerapan Teknologi (Digital Learning).'
            ],
            'hero' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/GrupSD-PDH_18-1-scaled.jpg',
            'facilities' => [
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/02/Lapangan-Outdoor-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/05/Aula-Serba-Guna-lt.3A-Kapasitas-300-orang-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/05/Ruang-Perpustakaan-SD-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/05/Lab.IPA-SD-2-scaled.jpg'
            ],
            'activities' => [
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/Karya-Wisata-scaled.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/Gelar-Karya-P5-scaled.jpg'
            ]
        ],
        'smp' => [
            'name' => 'SMP Cinta Kasih Tzu Chi',
            'slug' => 'smp',
            'description' => 'Mengintegrasikan pendidikan akademik dengan pengembangan karakter berbasis nilai cinta kasih. Sebagai "Green School", kami menerapkan prinsip ramah lingkungan.',
            'keunggulan' => [
                'Fokus Pendidikan Humanis.',
                'Pembelajaran Berbasis Proyek (PBL).',
                'Pengembangan Kepemimpinan.',
                'Green School Program.'
            ],
            'hero' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/11/19.-Marcella-Winata-scaled.jpg',
            'facilities' => [], // No specific facilities listed in prompt, using generic or empty
            'activities' => [
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/09/as2.jpg'
            ]
        ],
        'smk' => [
            'name' => 'SMK Cinta Kasih Tzu Chi',
            'slug' => 'smk',
            'description' => 'Mencetak lulusan yang kompeten, siap kerja, dan berkarakter luhur dengan fasilitas Teaching Factory standar industri. Jurusan: PPLG, AKL, MPLB.',
            'keunggulan' => [
                'Teaching Factory & Kunjungan Industri (Axioo Class).',
                'Sertifikasi Kompetensi Profesi.',
                'Praktek Kerja Industri (PRAKERIN).',
                'Inovasi Teknologi (Metaverse & AI).'
            ],
            'hero' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2025/02/20250217-LKDO-SMK.png',
            'facilities' => [], // No specific facilities listed
            'activities' => [
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/08/t1.jpg',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2025/09/020925-smkmetaverse.png',
                'https://cintakasihtzuchi.sch.id/wp-content/uploads/2024/09/pp1.jpg'
            ]
        ]
    ];

    private $newsData = [
        [
            'date' => '27 Nov 2025',
            'category' => 'Umum',
            'title' => 'Makna Kehidupan dari Seni Merangkai Bunga Jing Si',
            'image' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2025/11/1-3-600x600.jpg'
        ],
        [
            'date' => '26 Nov 2025',
            'category' => 'SD',
            'title' => 'Melatih Sikap Profesionalisme Melalui Fieldtrip',
            'image' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2025/11/1-2-600x600.jpg'
        ],
        [
            'date' => '25 Nov 2025',
            'category' => 'SMK',
            'title' => 'Serunya Belajar Akuntansi dengan Metode TGT',
            'image' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2025/11/Photo-3-x-2-900-x-600-px-2.png'
        ],
        [
            'date' => '24 Nov 2025',
            'category' => 'TK',
            'title' => 'Upacara Bendera untuk Anak Usia Dini, Pentingkah?',
            'image' => 'https://cintakasihtzuchi.sch.id/wp-content/uploads/2025/11/1-2-600x600.png'
        ]
    ];

    public function welcome()
    {
        return view('welcome', [
            'news' => $this->newsData,
            'jenjangs' => $this->jenjangData
        ]);
    }

    public function jenjang($slug)
    {
        if (!array_key_exists($slug, $this->jenjangData)) {
            abort(404);
        }
        return view('pages.jenjang', ['data' => $this->jenjangData[$slug]]);
    }
}
