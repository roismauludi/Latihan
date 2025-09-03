<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/User.php';

use Mpdf\Mpdf;

// Inisialisasi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi object user
$user = new User($db);

// Ambil semua data user
$result = $user->read();

// Buat HTML content untuk PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR MAHASISWA</h1>
        <p>Tanggal Export: ' . date('d/m/Y') . '</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Prodi</th>
                <th>Kelas</th>
                </tr>
                </thead>
                <tbody>';
                // <th>Tanggal Dibuat</th>

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . htmlspecialchars($row['nim']) . '</td>
                <td>' . htmlspecialchars($row['nama']) . '</td>
                <td>' . htmlspecialchars($row['jurusan']) . '</td>
                <td>' . htmlspecialchars($row['prodi']) . '</td>
                <td>' . htmlspecialchars($row['kelas']) . '</td>
                
            </tr>';
}
// <td>' . date('d/m/Y H:i', strtotime($row['created_at'])) . '</td>

$html .= '
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total data: ' . ($no - 1) . ' Mahasiswa</p>
    </div>
</body>
</html>';

// Buat instance mPDF
$mpdf = new Mpdf([
    'format' => 'A4',
    'orientation' => 'P', 'L' // P = Portrait, L = Landscape
]);

// Tulis HTML ke PDF
$mpdf->WriteHTML($html);

// Nama file export
$filename = 'daftar-Mahasiswa-' . date('Y-m-d') . '.pdf';

// Output langsung download
$mpdf->Output($filename, 'I'); // 'D' = Download, 'I' = Inline di browser
exit;
