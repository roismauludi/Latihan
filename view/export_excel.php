<?php
require_once '../vendor/autoload.php';
require_once '../models/User.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Set header untuk download file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="daftar-Mahasiswa-' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

// Buat instance spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul sheet
$sheet->setTitle('Data User');

// Set header kolom
$headers = [
    'A1' => 'No',
    'B1' => 'NIM',
    'C1' => 'Nama Lengkap',
    'D1' => 'Jurusan',
    'E1' => 'Program Studi',
    'F1' => 'Kelas',
    'G1' => 'Tanggal Dibuat',
    'H1' => 'Tanggal Update'
];

// Set header
foreach ($headers as $cell => $value) {
    $sheet->setCellValue($cell, $value);
}

// Style untuk header
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '000000'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        // 'startColor' => ['rgb' => '000000'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
];

$sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

// Set lebar kolom
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(20);
$sheet->getColumnDimension('H')->setWidth(20);

// Ambil data user
$user = new User();
$result = $user->read();

$row = 2;
$no = 1;

// Isi data
while ($data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $data['nim']);
    $sheet->setCellValue('C' . $row, $data['nama']);
    $sheet->setCellValue('D' . $row, $data['jurusan']);
    $sheet->setCellValue('E' . $row, $data['prodi']);
    $sheet->setCellValue('F' . $row, $data['kelas']);
    $sheet->setCellValue('G' . $row, $data['created_at'] ? date('d/m/Y H:i', strtotime($data['created_at'])) : '-');
    $sheet->setCellValue('H' . $row, $data['update_at'] ? date('d/m/Y H:i', strtotime($data['update_at'])) : '-');
    
    $row++;
    $no++;
}

// Style untuk data
$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
    'alignment' => [
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];

// Terapkan style ke semua data
$lastRow = $row - 1;
if ($lastRow > 1) {
    $sheet->getStyle('A2:H' . $lastRow)->applyFromArray($dataStyle);
    
    // Center alignment untuk kolom nomor dan kelas
    $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F2:F' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
}

// Tambahkan filter dan freeze pane
$sheet->setAutoFilter('A1:H1');
$sheet->freezePane('A2');

// Buat writer dan output file
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Hapus object dari memory
$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
exit;
?>
