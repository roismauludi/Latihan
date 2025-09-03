<?php
require_once '../models/User.php';

$user = new User();
$result = $user->read();

// Set timezone ke WIB
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data - Sistem Informasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        .btn-export {
            transition: all 0.3s ease;
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-excel {
            background: linear-gradient(45deg, #217346, #1e6b3a);
            border: none;
        }
        .btn-pdf {
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
        }
        .table th {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            color: white;
            border: none;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.1);
        }
        .export-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
        }
        .stats-card {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .stats-card h3 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <!-- Header
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <h3><?php echo mysqli_num_rows($result); ?></h3>
                                    <p class="mb-0">Total Data Mahasiswa</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                    <h3><?php echo date('d/m/Y'); ?></h3>
                                    <p class="mb-0">Tanggal Export</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                                    <h3><?php echo date('H:i'); ?></h3>
                                    <p class="mb-0">Waktu Export (WIB)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                                         <div class="card-header bg-success text-white">
                         <h4 class="mb-0">
                             <i class="fas fa-table me-2"></i>
                             Preview Data Mahasiswa
                             <small class="float-end">
                                 <span id="live-clock"><?php echo date('d/m/Y H:i:s'); ?> WIB</span>
                             </small>
                         </h4>
                     </div>
                    <div class="card-body">
                        <!-- Export Buttons di atas tabel -->
                        <?php if (mysqli_num_rows($result) > 0): ?>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="export_excel.php" class="btn btn-excel btn-sm text-white" target="blank">
                                        <i class="fas fa-file-excel me-2"></i>
                                        Export ke Excel
                                    </a>
                                    
                                    <a href="export_pdf.php" class="btn btn-pdf btn-sm text-white" target="blank">
                                        <i class="fas fa-file-pdf me-2"></i>
                                        Export ke PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Program Studi</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($result) > 0):
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)):
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><strong><?php echo $row['nim']; ?></strong></td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?php echo htmlspecialchars($row['jurusan']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark">
                                                    <?php echo $row['kelas']; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?> WIB</td>
                                        </tr>
                                    <?php 
                                        endwhile;
                                    else:
                                    ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                                <h5>Tidak ada data mahasiswa</h5>
                                                <p class="mb-0">Silakan tambahkan data mahasiswa terlebih dahulu</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <?php if (mysqli_num_rows($result) > 0): ?>
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Info:</strong> Data di atas adalah preview dari data yang akan di-export. 
                            Gunakan tombol export di atas tabel untuk mengunduh file.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Fungsi untuk update jam digital
        function updateClock() {
            const now = new Date();
            
            // Format tanggal dan waktu Indonesia
            const options = {
                timeZone: 'Asia/Jakarta',
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            
            const indonesiaTime = now.toLocaleString('id-ID', options);
            const formattedTime = indonesiaTime.replace(',', '') + ' WIB';
            
            // Update jam di header
            document.getElementById('live-clock').textContent = formattedTime;
        }
        
        // Update jam setiap detik
        setInterval(updateClock, 1000);
        
        // Update jam pertama kali saat halaman dimuat
        updateClock();
    </script>
</body>
</html>
