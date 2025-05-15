<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>SIS-APP | Surat Izin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<link rel="icon" href="/img/logo-SIS.jpg">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
body {
  background-color: #f8f9fa;
}

.dashboard-header {
  background-color: #cd2020;
  color: #fff;
  padding: 20px 0;
  text-align: center;
  border-radius: 0 0 10px 10px;
  margin-bottom: 30px;
}

.info-card {
  background: white;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  text-align: center;
  padding: 25px;
  transition: transform 0.2s ease;
  text-decoration: none;
  color: inherit;
  display: block;
  cursor: pointer;
}

.info-card:hover {
  transform: scale(1.03);
}

.info-icon {
  font-size: 28px;
  margin-bottom: 10px;
}

.info-title {
  font-weight: 600;
}

.info-number {
  font-size: 24px;
  font-weight: bold;
}

.section-title {
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 25px;
  color: #343a40;
}

.footer-box {
  margin-top: 50px;
  text-align: center;
}

.clock-date {
  font-size: 16px;
  color: #495057;
}

.back-btn {
  margin-top: 15px;
}

.modal-table {
  width: 100%;
}

.modal-table th,
.modal-table td {
  vertical-align: middle;
}
</style>
</head>
<body>

<div class="dashboard-header">
<h3 class="m-0">Halaman Surat Izin</h3>
<p class="m-0 fw-semibold">Informasi dan Statistik Surat Izin</p>
</div>

<div class="container">
<h4 class="section-title">Rekap Surat Izin</h4>
<div class="row g-4 justify-content-center">

  <div class="col-md-3 col-sm-6">
    <div class="info-card" data-bs-toggle="modal" data-bs-target="#sickLeaveModal">
      <div class="info-icon text-primary"><i class="fas fa-door-open"></i></div>
      <div class="info-title">Surat Izin <span class="text-primary">Sakit</span></div>
      <div class="info-number">1 Anak</div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <a href="{{route('keluar-kelas.create')}}" class="info-card">
      <div class="info-icon text-warning"><i class="fas fa-file-alt"></i></div>
      <div class="info-title">Surat Izin <span class="text-warning">Keluar Kelas</span></div>
      <div class="info-number">{{$suratTodayCount}} Anak</div>
    </a>
  </div>

  <div class="col-md-3 col-sm-6">
    <a href="{{route('keluar-sekolah.create')}}" class="info-card">
      <div class="info-icon text-danger"><i class="fas fa-school"></i></div>
      <div class="info-title">Surat Izin <span class="text-danger">Keluar Lingkungan Sekolah</span></div>
      <div class="info-number">{{$suratTodayCountSekolah}} Anak</div>
    </a>
  </div>

</div>

<div class="modal fade" id="sickLeaveModal" tabindex="-1" aria-labelledby="sickLeaveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sickLeaveModalLabel">Data Siswa Izin Sakit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped modal-table">
            <thead>
              <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="sickLeaveTable">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="footer-box mt-5">
  <div class="attendance-box">
    <div class="attendance-title">Jumlah Siswa Hadir Hari Ini</div>
    <div class="attendance-number">285</div>
  </div>
  <div class="clock-date mt-3">
    <span id="current-date"></span> - <span id="clock"></span>
  </div>
  <button class="btn btn-secondary back-btn mt-3" onclick="window.history.back()">
    <i class="fas fa-arrow-left me-1"></i> Kembali
  </button>
</div>

</div>

<script>
function updateClock() {
  const now = new Date();
  const hours = now.getHours().toString().padStart(2, '0');
  const minutes = now.getMinutes().toString().padStart(2, '0');
  const seconds = now.getSeconds().toString().padStart(2, '0');
  document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
}

function updateDate() {
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const today = new Date().toLocaleDateString('id-ID', options);
  document.getElementById('current-date').textContent = today;
}

document.addEventListener('DOMContentLoaded', function() {
  const tableBody = document.getElementById('sickLeaveTable');
  const dummyData = [
    { id: 1, nama: 'Budi Santoso', kelas: 'XII IPA 1', tanggal: '2025-05-07', status: 'Disetujui' },
    { id: 2, nama: 'Siti Aminah', kelas: 'XI IPS 2', tanggal: '2025-05-06', status: 'Menunggu' },
    { id: 3, nama: 'Ahmad Fauzi', kelas: 'X IPA 3', tanggal: '2025-05-05', status: 'Ditolak' },
  ];

  dummyData.forEach(data => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${data.nama}</td>
      <td>${data.kelas}</td>
      <td>${data.tanggal}</td>
      <td>${data.status}</td>
      <td><button class="btn btn-sm btn-primary" onclick="viewDetail(${data.id})">Lihat Detail</button></td>
    `;
    tableBody.appendChild(row);
  });
});

function viewDetail(id) {
  alert(`Melihat detail untuk ID: ${id}`);
}

updateDate();
setInterval(updateClock, 1000);
</script>


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