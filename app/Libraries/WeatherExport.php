<?php

namespace App\Libraries;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class WeatherExport
{
    /**
     * Generate dan stream file Excel ke browser
     */
    public function exportExcel(array $port, array $weathers, ?string $startDate = null, ?string $endDate = null): void
    {
        $code     = $port['code'];
        $portName = $port['name'] ?? $code;

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Prakiraan Cuaca');

        // Header Title
        $sheet->setCellValue('A1', 'DATA PRAKIRAAN CUACA PELABUHAN - ' . strtoupper($portName));
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $periodText = 'Periode: ' . (!empty($startDate) ? $startDate : 'Awal') . ' s/d ' . (!empty($endDate) ? $endDate : 'Akhir');
        $sheet->setCellValue('A2', $periodText);
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $headers = [
            'No',
            'Waktu (UTC)',
            'Cuaca',
            'Suhu (°C)',
            'Kelembapan (%)',
            'Jarak Pandang (NM)',
            'Arah Angin',
            'Kecepatan Angin (Knot)',
            'Tinggi Gelombang (m)',
            'Kategori Gelombang',
            'Arah Arus',
            'Kecepatan Arus (Knot)',
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '4', $header);
            $col++;
        }

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0D6EFD'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A4:L4')->applyFromArray($headerStyle);
        $sheet->getRowDimension(4)->setRowHeight(25);

        // Isi Data
        $row = 5;
        $no  = 1;
        foreach ($weathers as $w) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, date('d-m-Y H:i', strtotime($w['forecast_time'])));
            $sheet->setCellValue('C' . $row, ucfirst($w['weather'] ?? '-'));
            $sheet->setCellValue('D' . $row, $w['temp_avg'] ?? '-');
            $sheet->setCellValue('E' . $row, $w['rh_avg'] ?? '-');
            $sheet->setCellValue('F' . $row, $w['visibility'] ?? '-');
            $sheet->setCellValue('G' . $row, $w['wind_from'] ?? '-');
            $sheet->setCellValue('H' . $row, $w['wind_speed'] ?? '-');
            $sheet->setCellValue('I' . $row, $w['wave_height'] ?? '-');
            $sheet->setCellValue('J' . $row, $w['wave_cat'] ?? '-');
            $sheet->setCellValue('K' . $row, $w['current_to'] ?? '-');
            $sheet->setCellValue('L' . $row, $w['current_speed'] ?? '-');

            $sheet->getStyle("A{$row}:B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("D{$row}:L{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $row++;
        }

        $lastRow = $row - 1;
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['rgb' => 'D3D3D3'],
                ],
            ],
        ];
        $sheet->getStyle("A4:L{$lastRow}")->applyFromArray($borderStyle);

        foreach (range('A', 'L') as $colId) {
            $sheet->getColumnDimension($colId)->setAutoSize(true);
        }

        $filename = "Cuaca_Pelabuhan_{$code}_" . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    /**
     * Generate dan stream file PDF ke browser
     */
    public function exportPdf(array $port, array $weathers, ?string $startDate = null, ?string $endDate = null): void
    {
        $code     = $port['code'];
        $portName = $port['name'] ?? $code;

        $data = [
            'title'     => 'Laporan Cuaca ' . $portName,
            'port'      => $port,
            'weathers'  => $weathers,
            'startDate' => $startDate ?? '',
            'endDate'   => $endDate ?? '',
        ];

        $html = view('ports/weather_pdf', $data);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $filename = "Laporan_Cuaca_{$portName}_" . date('Ymd_His') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => false]);
        exit();
    }
}
