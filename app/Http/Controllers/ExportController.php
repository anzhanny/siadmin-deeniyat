<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Http\Response;

class ExportController extends Controller
{
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul laporan
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', 'LAPORAN PEMBAYARAN SPP');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header tabel
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Siswa');
        $sheet->setCellValue('C3', 'Kelas');
        $sheet->setCellValue('D3', 'Status SPP');

        // Styling header
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);
        $sheet->getStyle('A3:D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:D3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Data contoh (nanti bisa diganti dari database)
        $data = [
            ['nama' => 'Andi', 'kelas' => 'VII A', 'status' => 'Lunas'],
            ['nama' => 'Budi', 'kelas' => 'VII B', 'status' => 'Belum Lunas'],
            ['nama' => 'Citra', 'kelas' => 'VII A', 'status' => 'Lunas'],
        ];

        $row = 4;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['kelas']);
            $sheet->setCellValue('D' . $row, $item['status']);

            // Tambahkan border di setiap baris data
            $sheet->getStyle('A' . $row . ':D' . $row)
                ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            $row++;
        }

        // Auto size kolom
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Buat file Excel untuk di-download
        $writer = new Xlsx($spreadsheet);
        $filename = "laporan-spp.xlsx";

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }
}
