<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS-APP | Surat Izin Keluar Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            .button-bar, .carousel-btn-left, .carousel-btn-right {
                display: none !important;
            }

            @page {
                size: A4 portrait;
                margin: 20mm;
            }

            html, body {
                width: 210mm;
                height: 297mm;
                background: white;
            }

            .surat-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-relaxed">
    <div class="button-bar fixed top-0 left-0 w-full bg-white shadow-md z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('keluar-kelas.create') }}"
               class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 flex items-center">
                <span class="mr-2">←</span> Kembali
            </a>
            <div class="text-gray-800 font-semibold text-lg">
                Total Surat Keluar Kelas yang Dibuat Hari Ini: {{ $suratHariIni->count() }}
            </div>
            <button onclick="window.print()"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-200 flex items-center">
                <span class="mr-2">🖨️</span> Cetak
            </button>
        </div>
    </div>

    @if($suratSebelumnya)
        <a href="{{ route('keluar-kelas.surat', ['id' => $suratSebelumnya->id]) }}"
           class="carousel-btn-left fixed left-4 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition duration-200">
            ←
        </a>
    @endif

    @if($suratBerikutnya)
        <a href="{{ route('keluar-kelas.surat', ['id' => $suratBerikutnya->id]) }}"
           class="carousel-btn-right fixed right-4 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition duration-200">
            →
        </a>
    @endif

    <div class="surat-container container mx-auto mt-24 max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <img src="/img/logo-SIS.jpg" alt="Logo Sekolah" class="logo mx-auto w-24 h-24 object-cover rounded-full mb-6">
        <h3 class="text-2xl font-bold text-center mb-4">SURAT IZIN KELUAR KELAS</h3>

        @php
            $sortedSuratHariIni = $suratHariIni->sortBy('created_at')->values();
            $nomor = $sortedSuratHariIni->search(function ($item) use ($surat) {
                return $item->id === $surat->id;
            }) + 1;

            function romanNumber($number) {
                $roman = [
                    'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
                    'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
                    'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
                ];
                $result = '';
                foreach ($roman as $key => $value) {
                    while ($number >= $value) {
                        $result .= $key;
                        $number -= $value;
                    }
                }
                return $result;
            }
        @endphp

        <p class="text-center text-lg font-semibold mb-4">
            No. {{ romanNumber($nomor) }}/SMK/SIS/{{ date('Y') }}
        </p>
        <hr class="border-gray-300 mb-8">

        <p class="mb-2">Kepada Yth,</p>
        <p class="mb-4">{{ $surat->kepada_yth }}</p>
        <p class="mb-4">Dengan hormat,</p>

        <p class="mb-4">Nama siswa yang mengajukan izin keluar kelas adalah:</p>
        <table class="w-full mb-6">
            <tr>
                <td class="w-40 py-2">Nama</td>
                <td>: {{ $surat->nama }}</td>
            </tr>
            <tr>
                <td class="py-2">Kelas</td>
                <td>: {{ $surat->kelas->kelas }} - {{ $surat->kelas->jurusan }}</td>
            </tr>
            <tr>
                <td class="py-2">Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="py-2">Jam Ke</td>
                <td>: {{ $surat->jam_ke }}</td>
            </tr>
        </table>

        <p class="mb-2">Dengan alasan:</p>
        <p class="ml-6 mb-8">{{ $surat->pesan_keluar_kelas }}</p>

        <p class="mb-8">Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

        <div class="flex justify-between mt-12">
            <div class="w-5/12 text-center">
                <p class="mb-16">Guru Piket,</p>
                <p>______________________</p>
            </div>
            <div class="w-5/12 text-center">
                <p class="mb-16">Hormat saya,</p>
                <p>{{ $surat->nama }}</p>
            </div>
        </div>
    </div>
</body>
</html>
