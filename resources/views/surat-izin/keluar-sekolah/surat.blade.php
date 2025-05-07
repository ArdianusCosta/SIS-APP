<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIS-APP | Surat Izin Keluar Sekolah</title>
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
        <a href="{{ route('keluar-sekolah.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 flex items-center">
            <span class="mr-2">←</span> Kembali
        </a>
        <div class="text-gray-800 font-semibold text-lg">
            Total Surat Keluar Sekolah yang Dibuat Hari Ini: {{ $keluarSekolah->count() }}
        </div>
        <button onclick="window.print()"
                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-200 flex items-center">
            <span class="mr-2">🖨️</span> Cetak
        </button>
    </div>
</div>

<a href="{{ route('keluar-sekolah.surat', ['id' => $suratTerlama->id]) }}"
   class="carousel-btn-left fixed left-4 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition duration-200">
    ←
</a>
<a href="{{ route('keluar-sekolah.surat', ['id' => $suratTerbaru->id]) }}"
   class="carousel-btn-right fixed right-4 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-600 transition duration-200">
    →
</a>

<div class="surat-container container mx-auto mt-24 max-w-2xl bg-white p-8 rounded-lg shadow-lg">
    <img src="/img/logo-SIS.jpg" alt="Logo Sekolah" class="logo mx-auto w-24 h-24 object-cover rounded-full mb-6">
    <h3 class="text-2xl font-bold text-center mb-4">SURAT IZIN KELUAR SEKOLAH</h3>
    <hr class="border-gray-300 mb-8">

    <p class="mb-2">Kepada Yth,</p>
    <p class="mb-4">{{ $keluarSekolah->kepada_yth }}</p>
    <p class="mb-4">Dengan hormat,</p>

    <p class="mb-4">Nama siswa yang mengajukan izin keluar sekolah adalah:</p>
    <table class="w-full mb-6">
        <tr>
            <td class="w-40 py-2">Nama</td>
            <td>: {{ $keluarSekolah->nama }}</td>
        </tr>
        <tr>
            <td class="py-2">Kelas</td>
            <td>: {{ $keluarSekolah->kelas->kelas }} - {{ $keluarSekolah->kelas->jurusan }}</td>
        </tr>
        <tr>
            <td class="py-2">Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($keluarSekolah->tanggal_surat)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="py-2">Jam Ke</td>
            <td>: {{ $keluarSekolah->jam_ke }}</td>
        </tr>
    </table>

    <p class="mb-2">Dengan alasan:</p>
    <p class="ml-6 mb-8">{{ $keluarSekolah->pesan_keluar_sekolah }}</p>

    <p class="mb-8">Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

    <div class="flex justify-between mt-12">
        <div class="w-5/12 text-center">
            <p class="mb-16">Guru Piket,</p>
            <p>______________________</p>
        </div>
        <div class="w-5/12 text-center">
            <p class="mb-16">Hormat saya,</p>
            <p>{{ $keluarSekolah->nama }}</p>
        </div>
    </div>
</div>


<script type="text/javascript">
    var gk_isXlsx = false;
    var gk_xlsxFileLookup = {};
    var gk_fileData = {};
    function filledCell(cell) {
      return cell !== '' && cell != null;
    }
    function loadFileData(filename) {
    if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
        try {
            var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
            var firstSheetName = workbook.SheetNames[0];
            var worksheet = workbook.Sheets[firstSheetName];
            var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
            var filteredData = jsonData.filter(row => row.some(filledCell));
            var headerRowIndex = filteredData.findIndex((row, index) =>
              row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
            );
            if (headerRowIndex === -1 || headerRowIndex > 25) {
              headerRowIndex = 0;
            }

            var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex));
            csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
            return csv;
        } catch (e) {
            console.error(e);
            return "";
        }
    }
    return gk_fileData[filename] || "";
    }
    </script>

</body>
</html>