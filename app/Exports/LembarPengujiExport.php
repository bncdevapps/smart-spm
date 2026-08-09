<?php

namespace App\Exports;

use App\Models\Spm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class LembarPengujiExport extends DefaultValueBinder implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithCustomValueBinder
{
    /**
     * Bind value to a cell explicitly setting strings as TYPE_STRING
     * so that numeric strings (e.g. SP2D, Nomor SPM) are not converted
     * to scientific notation (3.21321E+12) in Excel.
     */
    public function bindValue(Cell $cell, $value)
    {
        if (is_string($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }

    protected $tanggal;
    protected $instansi;
    protected $tanggal_cetak;

    public function __construct($instansi, $tanggal, $tanggal_cetak)
    {

        $this->tanggal = $tanggal;
        $this->instansi = $instansi;
        $this->tanggal_cetak = $tanggal_cetak;
    }


    public function collection()
    {
        // $query = Spm::select();
        $query = Spm::select();

            $query->where('status_ajukan', 'sp2d terbit');
            if ($this->instansi !== 'semua') {
                $query->where('instansi', $this->instansi);  
            }             
            $query->where('tanggal', $this->tanggal);          
        return $query->get();
    }

    public function map($row): array
    {
        static $counter = 0; // Untuk nomor urut
        $counter++;
          return [
                $counter,
                $row->nomor_sp2d,
                $row->tanggal->format('d M Y'),
                $row->jenis,
                'Rp'.number_format($row->jumlah),
                'Rp'.number_format($row->ppn + $row->jumlah_pajak_lain +$row->jumlah_potongan),
                'Rp'.number_format($row->jumlah_netto),
                $row->instansi,
                $row->penyedia,
            ];        
    }

    // Header kolom

    public function headings(): array
    {
           return [
            ['PEMERINTAH KABUPATEN TABALONG'],
            ['DAFTAR PENGUJI'],
            ['Tanggal Cetak '. $this->tanggal_cetak ],
                ['No.',
                'Nomor SP2D',
                'Tanggal',
                'Jenis SP2D',
                'Bruto',
                'Potongan',
                'Netto',
                'Nama SKPD',
                'Nama Pihak ke-3',]
            ];       
    }

    // Menyesuaikan gaya dan layout sheet
    public function registerEvents(): array
    {
      return [
                AfterSheet::class => function (AfterSheet $event) {
                    $sheet = $event->sheet;
                    // Mengatur lebar kolom
                    $sheet->getDelegate()->getColumnDimension('A')->setWidth(5);  // No.
                    $sheet->getDelegate()->getColumnDimension('B')->setWidth(30); // Instansi
                    $sheet->getDelegate()->getColumnDimension('C')->setWidth(15); // Nomor
                    $sheet->getDelegate()->getColumnDimension('D')->setWidth(15); // Nilai Belanja
                    $sheet->getDelegate()->getColumnDimension('E')->setWidth(15); // Kode Akun Pajak
                    $sheet->getDelegate()->getColumnDimension('F')->setWidth(15); // Kode Jenis Setoran
                    $sheet->getDelegate()->getColumnDimension('G')->setWidth(15); // Jenis Pajak dan Nominal
                    $sheet->getDelegate()->getColumnDimension('H')->setWidth(15);
                    $sheet->getDelegate()->getColumnDimension('I')->setWidth(30); // NPWP

                    // Mengaktifkan wrap text di kolom tertentu
                    // $sheet->getDelegate()->getStyle('B3:I10')->getAlignment()->setWrapText(true);
                    $sheet->getDelegate()->getStyle('A1:I1000') // Sesuaikan range jika perlu
                        ->getAlignment()->setWrapText(true);

                    // Merge cells untuk judul utama dan subjudul
                    $sheet->mergeCells('A1:I1'); // PEMERINTAH KABUPATEN TABALONG
                    $sheet->mergeCells('A2:I2'); // (nama instansi)
                    $sheet->mergeCells('A3:I3'); // (nama instansi)
                    

                    // Mengatur alignment
                    // $sheet->getDelegate()->getStyle('A3:O5')->getAlignment()->setHorizontal('center');
                    // $sheet->getDelegate()->getStyle('A3:O5')->getAlignment()->setVertical('center');
                    // $sheet->getDelegate()->getStyle('E3:J3')->getAlignment()->setHorizontal('center');
                    // $sheet->getDelegate()->getStyle('E3:J3')->getAlignment()->setVertical('center');
                    // $sheet->getDelegate()->getStyle('G4:J4')->getAlignment()->setHorizontal('center');
                    // $sheet->getDelegate()->getStyle('G4:J4')->getAlignment()->setVertical('center');
                    // $sheet->getDelegate()->getStyle('A5:O5')->getAlignment()->setHorizontal('center');
                    // $sheet->getDelegate()->getStyle('A5:O5')->getAlignment()->setVertical('center');

                    // Border untuk header
                    $sheet->getDelegate()->getStyle('A4:I4')->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                    // Styling untuk header
                    $sheet->getDelegate()->getStyle('A1:I4')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'name' => 'Times New Roman',
                            'size' => 12,
                        ],
                    ]);
                    $sheet->getDelegate()->getStyle('A5:I1000')->applyFromArray([
                        'font' => [
                            'name' => 'Times New Roman',
                            'size' => 12,
                        ],
                    ]);
                },
            ];

            // return [
            //     AfterSheet::class => function (AfterSheet $event) {
            //         $sheet = $event->sheet->getDelegate();

            //         $data = $this->collection(); // Ambil data yang akan digunakan
            //         $startRow = 2; // Data dimulai dari baris kedua (baris pertama adalah header)

            //         // foreach ($data as $index => $row) {
            //         //     $cell = 'H' . ($startRow + $index); // Kolom H (untuk link dokumen)
            //         //     $sheet->getCell($cell)->setValue('Preview ' . $row->nomor); // Teks yang akan ditampilkan
            //         //     $sheet->getCell($cell)->getHyperlink()->setUrl(route('preview.pdf', ['dn' => $row->nomor, 'file' => $row->dokumen])); // Link URL
            //         // }

            //         // // Tambahkan gaya untuk seluruh kolom hyperlink
            //         // $endRow = $startRow + count($data) - 1;
            //         // $sheet->getStyle("H{$startRow}:H{$endRow}")->applyFromArray([
            //         //     'font' => [
            //         //         'color' => ['rgb' => '0000FF'], // Warna biru
            //         //         'underline' => 'single',       // Underline
            //         //         'name' => 'Times New Roman',
            //         //         'size' => 12,
            //         //     ],
            //         // ]);

            //         // Border untuk header
            //         $sheet->getStyle('A1:H1')->applyFromArray([
            //             'borders' => [
            //                 'allBorders' => [
            //                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            //                 ],
            //             ],
            //         ]);

            //         // Styling untuk header
            //         $sheet->getStyle('A1:H1')->applyFromArray([
            //             'font' => [
            //                 'bold' => true,
            //                 'name' => 'Times New Roman',
            //                 'size' => 12,
            //             ],
            //         ]);
            //     },
            // ];
        
    }
}
