<?php
require_once '../models/User.php';

$user = new User();
$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Validasi input
                if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['jurusan']) || empty($_POST['prodi']) || empty($_POST['kelas'])) {
                    $error = "Semua field harus diisi!";
                } elseif (!preg_match('/^\d+$/', $_POST['nim'])) {
                    $error = "NIM harus berupa angka!";
                } elseif ($user->checkNimExists($_POST['nim'])) {
                    $error = "NIM sudah terdaftar!";
                } else {
                    $user->nim = $_POST['nim'];
                    $user->nama = $_POST['nama'];
                    $user->jurusan = $_POST['jurusan'];
                    $user->prodi = $_POST['prodi'];
                    $user->kelas = $_POST['kelas'];
                    
                    if ($user->create()) {
                        $message = "Data berhasil ditambahkan!";
                    } else {
                        $error = "Gagal menambahkan data!";
                    }
                }
                break;
                
            case 'update':
                if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['jurusan']) || empty($_POST['prodi']) || empty($_POST['kelas'])) {
                    $error = "Semua field harus diisi!";
                } elseif (!preg_match('/^\d+$/', $_POST['nim'])) {
                    $error = "NIM harus berupa angka!";
                } elseif ($user->checkNimExists($_POST['nim'], $_POST['id'])) {
                    $error = "NIM sudah terdaftar!";
                } else {
                    $user->id = $_POST['id'];
                    $user->nim = $_POST['nim'];
                    $user->nama = $_POST['nama'];
                    $user->jurusan = $_POST['jurusan'];
                    $user->prodi = $_POST['prodi'];
                    $user->kelas = $_POST['kelas'];
                    
                    if ($user->update()) {
                        $message = "Data berhasil diupdate!";
                    } else {
                        $error = "Gagal mengupdate data!";
                    }
                }
                break;
        }
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $user->id = $_GET['delete'];
    if ($user->delete()) {
        $message = "Data berhasil dihapus!";
    } else {
        $error = "Gagal menghapus data!";
    }
}

// Get user for edit
$edit_user = null;
if (isset($_GET['edit'])) {
    $user->id = $_GET['edit'];
    $edit_user = $user->readOne();
}

// Get all users
$result = $user->read();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Mahasiswa</title>
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
        .btn-action {
            margin: 0 2px;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-users me-2"></i>
                            Sistem Informasi Mahasiswa
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Alert Messages -->
                        <?php if ($message): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Form Input/Edit -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-edit me-2"></i>
                                    <?php echo $edit_user ? 'Edit Data Mahasiswa' : 'Tambah Data Mahasiswa Baru'; ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="<?php echo $edit_user ? 'update' : 'create'; ?>">
                                    <?php if ($edit_user): ?>
                                        <input type="hidden" name="id" value="<?php echo $edit_user['id']; ?>">
                                    <?php endif; ?>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nim" name="nim" 
                                                   value="<?php echo $edit_user ? $edit_user['nim'] : ''; ?>" 
                                                   placeholder="Masukkan NIM Mahasiswa  " required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama" name="nama" 
                                                   value="<?php echo $edit_user ? $edit_user['nama'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="jurusan" name="jurusan" required>
                                                <option value="">Pilih Jurusan</option>
                                                <option value="Manajemen dan Bisnis" <?php echo ($edit_user && $edit_user['jurusan'] == 'Manajemen dan Bisnis') ? 'selected' : ''; ?>>Manajemen dan Bisnis</option>
                                                <option value="Teknik Elektro" <?php echo ($edit_user && $edit_user['jurusan'] == 'Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro</option>
                                                <option value="Teknik Informatika" <?php echo ($edit_user && $edit_user['jurusan'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                                                <option value="Teknik Mesin" <?php echo ($edit_user && $edit_user['jurusan'] == 'Teknik Mesin') ? 'selected' : ''; ?>>Teknik Mesin</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                            <select class="form-select" id="prodi" name="prodi" required>
                                                <option value="">Pilih Program Studi</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kelas" name="kelas" 
                                                   value="<?php echo $edit_user ? $edit_user['kelas'] : ''; ?>" 
                                                   placeholder="Contoh: 7A Malam, 3B Pagi, 1C Siang" required>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary" title="Simpan Data">
                                            <i class="fas fa-save me-2"></i>
                                            <?php echo $edit_user ? 'Update Data' : 'Simpan Data'; ?>
                                        </button>
                                        <?php if ($edit_user): ?>
                                            <a href="index.php" class="btn btn-secondary">
                                                <i class="fas fa-times me-2"></i>Batal
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-table me-2"></i>
                                    Data Mahasiswa
                                </h5>
                                <a href="export.php" class="btn btn-success btn-sm float-end" title="Export Data">
                                <i class="fas fa-file-export me-1"></i>Export Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Program Studi</th>
                                                <th>Kelas</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (mysqli_num_rows($result) > 0):
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)):
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $row['nim']; ?></td>
                                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                                                    <td><?php echo $row['kelas']; ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                                                    <td>
                                                        <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-action" 
                                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php 
                                                endwhile;
                                            else:
                                            ?>
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">
                                                        <i class="fas fa-inbox me-2"></i>
                                                        Tidak ada data mahasiswa
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Data program studi berdasarkan jurusan
        const prodiData = {
            'Manajemen dan Bisnis': [
                'S1 Manajemen',
                'S1 Akuntansi',
                'S1 Ekonomi Pembangunan',
                'D3 Manajemen Bisnis',
                'D3 Akuntansi'
            ],
            'Teknik Elektro': [
                'S1 Teknik Elektro',
                'S1 Teknik Telekomunikasi',
                'S1 Teknik Instrumentasi',
                'D3 Teknik Elektro',
                'D3 Teknik Telekomunikasi'
            ],
            'Teknik Informatika': [
                'S1 Teknik Informatika',
                'S1 Sistem Informasi',
                'S1 Teknik Komputer',
                'D3 Manajemen Informatika',
                'D3 Teknik Komputer'
            ],
            'Teknik Mesin': [
                'S1 Teknik Mesin',
                'S1 Teknik Industri',
                'S1 Teknik Material',
                'D3 Teknik Mesin',
                'D3 Teknik Industri'
            ]
        };

        // Fungsi untuk mengupdate dropdown program studi
        function updateProdi() {
            const jurusanSelect = document.getElementById('jurusan');
            const prodiSelect = document.getElementById('prodi');
            const selectedJurusan = jurusanSelect.value;
            
            // Reset program studi
            prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';
            
            if (selectedJurusan && prodiData[selectedJurusan]) {
                prodiData[selectedJurusan].forEach(prodi => {
                    const option = document.createElement('option');
                    option.value = prodi;
                    option.textContent = prodi;
                    prodiSelect.appendChild(option);
                });
            }
        }

        // Event listener untuk perubahan jurusan
        document.getElementById('jurusan').addEventListener('change', updateProdi);

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Jika sedang edit, set program studi yang sesuai
            const jurusanSelect = document.getElementById('jurusan');
            const prodiSelect = document.getElementById('prodi');
            
            if (jurusanSelect.value) {
                updateProdi();
                
                // Set program studi yang sudah ada (untuk mode edit)
                const currentProdi = '<?php echo $edit_user ? $edit_user['prodi'] : ''; ?>';
                if (currentProdi) {
                    prodiSelect.value = currentProdi;
                }
            }
        });
    </script>
</body>
</html>
