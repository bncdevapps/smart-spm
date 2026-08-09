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

class SpmExport extends DefaultValueBinder implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents, WithCustomValueBinder
{
    /**
     * Bind value to a cell explicitly setting strings as TYPE_STRING
     * so that numeric strings (e.g. 3213213213132) are not converted
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

    protected $kode;
    protected $status;
    protected $dari_tanggal;
    protected $sampai_tanggal;
    protected $instansi;
    protected $filter_penyedia;

    public function __construct($kode, $instansi, $dari_tanggal, $sampai_tanggal, $status, $filter_penyedia = 'semua')
    {

        $this->kode = $kode;
        $this->status = $status;
        $this->dari_tanggal = $dari_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
        $this->instansi = $instansi;
        $this->filter_penyedia = $filter_penyedia;
    }


    public function collection()
    {
        $query = Spm::select();

        if ($this->kode == 1) {
            if ($this->status !== 'semua' && !empty($this->status)) {
                $query->where('status_ajukan', $this->status);
            }
        } else {
            $query->where('status_ajukan', 'sp2d terbit');
        }

        if (Auth()->user()->otorisasi == 'bendahara') {
            $query->where('instansi', Auth()->user()->name_instansi);
        }
        
        if (Auth()->user()->otorisasi == 'admin') {
            if ($this->instansi !== 'semua' && !empty($this->instansi)) {
                $query->where('instansi', $this->instansi);
            }
        }

        if ($this->filter_penyedia !== 'semua' && !empty($this->filter_penyedia)) {
            $query->where('penyedia', $this->filter_penyedia);
        }

        $query->where('status_ajukan', '!=', 'draft');


        $query->whereBetween('tanggal', [
            \Carbon\Carbon::parse($this->dari_tanggal)->startOfDay(),
            \Carbon\Carbon::parse($this->sampai_tanggal)->endOfDay(),
        ]);

        return $query->get();
    }

    public function map($row): array
    {
        static $counter = 0; // Untuk nomor urut
        $counter++;
        if ($this->kode == 1) {
            $dokumenLinks = [];
                $dokumenList = $row->dokumen_list;
                if (!empty($dokumenList) && is_array($dokumenList)) {
                    foreach ($dokumenList as $doc) {
                        if (!empty($doc['file'])) {
                            $dokumenLinks[] = route('preview.pdf', ['dn' => $row->nomor, 'file' => $doc['file']]);
                        }
                    }
                }

                return [
                $counter, // Nomor urut
                $row->tanggal ? $row->tanggal->format('d M Y') : '-',
                (string) $row->nomor,
                $row->jenis,
                (float) $row->jumlah,
                // number_format($row->jumlah, 0, ',', '.'),
                $row->penyedia,
                Str::upper($row->status_ajukan === 'diajukan' ? 'diusulkan' : $row->status_ajukan),
                !empty($dokumenLinks) ? implode("\n", $dokumenLinks) : '-',
            ];
        } elseif ($this->kode == 2) {
            $ppnStr = (float) $row->ppn > 0 ? (float) $row->ppn . (!empty($row->id_biling_ppn) ? " (Billing: {$row->id_biling_ppn})" : '') : '0';

            $pajakLainStr = '-';
            $pajakLainList = $row->pajak_lain_items;
            if (!empty($pajakLainList) && is_array($pajakLainList)) {
                $pItems = [];
                foreach ($pajakLainList as $pItem) {
                    $pItems[] = ($pItem['jenis'] ?? '') . ': Rp. ' . number_format((float) ($pItem['jumlah'] ?? 0), 0, ',', '.') . (!empty($pItem['id_biling']) ? " (Billing: {$pItem['id_biling']})" : '');
                }
                $pajakLainStr = implode("\n", $pItems);
            } else if (!empty($row->pajak_lain)) {
                $pajakLainStr = $row->pajak_lain . ' (Rp. ' . number_format((float) $row->jumlah_pajak_lain, 0, ',', '.') . ')';
            }

            $potonganStr = '-';
            $potonganList = $row->potongan_items;
            if (!empty($potonganList) && is_array($potonganList)) {
                $potItems = [];
                foreach ($potonganList as $pot) {
                    $potItems[] = ($pot['jenis'] ?? '') . ': Rp. ' . number_format((float) ($pot['jumlah'] ?? 0), 0, ',', '.') ;
                }
                $potonganStr = implode("\n", $potItems);
            } else if (!empty($row->potongan)) {
                $potonganStr = $row->potongan . ' (Rp. ' . number_format((float) $row->jumlah_potongan, 0, ',', '.') . ')';
            }

            return [
                $counter, // Nomor urut
                $row->instansi,
                (string) $row->nomor_sp2d,
                (float) $row->jumlah,
                $ppnStr,
                $pajakLainStr,
                $potonganStr,
                (float) $row->jumlah_netto,
                (string) $row->npwp_bendahara,
                $row->penyedia,
                (string) $row->ntpn,
                $row->tanggal_bayar_pajak ? $row->tanggal_bayar_pajak->format('d M Y') : '-',
            ];
        }
    }

    // Header kolom

    public function headings(): array
    {
        if ($this->kode == 1) {
            return [
                'No.',
                'Tanggal SPM',
                'Nomor SPM',
                'Jenis SPM',
                'Jumlah Pengajuan',
                'Nama Pihak Ketiga/Perusahaan/Penyedia',
                'Status SPM',
                'Dokumen',
            ];
        } elseif ($this->kode == 2) {
            return [
                ['PEMERINTAH KABUPATEN TABALONG'], // Judul utama
                [Auth()->user()->name_instansi],               // Subjudul
                [
                    'No.',
                    'INSTANSI',
                    'SP2D',
                    '',
                    'POTONGAN PAJAK & DEDUCTION',
                    '',
                    '',
                    '',
                    'NPWP BENDAHARA/REKANAN',
                    'NAMA BENDAHARA/REKANAN',
                    'NTPN',
                    'TANGGAL BAYAR',
                ],
                [
                    '',
                    '',
                    'NOMOR',
                    'NILAI BELANJA',
                    'PPN',
                    'PAJAK LAINNYA',
                    'POTONGAN',
                    'NILAI NETTO',
                    '',
                    '',
                    '',
                    '',
                ],
                [
                    '(1)',
                    '(2)',
                    '(3)',
                    '(4)',
                    '(5)',
                    '(6)',
                    '(7)',
                    '(8)',
                    '(9)',
                    '(10)',
                    '(11)',
                    '(12)',
                ],
            ];
        }
    }

    // Menyesuaikan gaya dan layout sheet
    public function registerEvents(): array
    {
        if ($this->kode == 1) {
            return [
                AfterSheet::class => function (AfterSheet $event) {
                    $sheet = $event->sheet->getDelegate();

                    $data = $this->collection(); // Ambil data yang akan digunakan
                    $startRow = 2; // Data dimulai dari baris kedua (baris pertama adalah header)

                    foreach ($data as $index => $row) {
                        $cell = 'H' . ($startRow + $index); // Kolom H (untuk link dokumen)
                        $dokumenList = $row->dokumen_list;
                        if (!empty($dokumenList) && is_array($dokumenList)) {
                            $firstDoc = $dokumenList[0];
                            if (!empty($firstDoc['file'])) {
                                $label = count($dokumenList) > 1
                                    ? 'Preview ' . $row->nomor . ' (' . count($dokumenList) . ' file)'
                                    : 'Preview ' . $row->nomor;
                                $sheet->getCell($cell)->setValue($label);
                                $sheet->getCell($cell)->getHyperlink()->setUrl(route('preview.pdf', ['dn' => $row->nomor, 'file' => $firstDoc['file']]));
                            }
                        } else {
                            $sheet->getCell($cell)->setValue('-');
                        }
                    }

                    // Tambahkan gaya untuk seluruh kolom hyperlink
                    $endRow = $startRow + count($data) - 1;
                    $sheet->getStyle("H{$startRow}:H{$endRow}")->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'], // Warna biru
                            'underline' => 'single',       // Underline
                            'name' => 'Times New Roman',
                            'size' => 12,
                        ],
                    ]);

                    // Border untuk header
                    $sheet->getStyle('A1:H1')->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                    // Styling untuk header
                    $sheet->getStyle('A1:H1')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'name' => 'Times New Roman',
                            'size' => 12,
                        ],
                    ]);
                },
            ];
        } elseif ($this->kode == 2) {
            return [
                AfterSheet::class => function (AfterSheet $event) {
                    $sheet = $event->sheet;

                    // Mengatur lebar kolom (Total 12 Kolom A - L)
                    $sheet->getDelegate()->getColumnDimension('A')->setWidth(5);  // No.
                    $sheet->getDelegate()->getColumnDimension('B')->setWidth(30); // Instansi
                    $sheet->getDelegate()->getColumnDimension('C')->setWidth(20); // Nomor SP2D
                    $sheet->getDelegate()->getColumnDimension('D')->setWidth(20); // Nilai Belanja (Bruto)
                    $sheet->getDelegate()->getColumnDimension('E')->setWidth(20); // PPN
                    $sheet->getDelegate()->getColumnDimension('F')->setWidth(25); // Pajak Lainnya
                    $sheet->getDelegate()->getColumnDimension('G')->setWidth(25); // Potongan
                    $sheet->getDelegate()->getColumnDimension('H')->setWidth(20); // Nilai Netto
                    $sheet->getDelegate()->getColumnDimension('I')->setWidth(20); // NPWP
                    $sheet->getDelegate()->getColumnDimension('J')->setWidth(30); // Nama Bendahara/Rekanan
                    $sheet->getDelegate()->getColumnDimension('K')->setWidth(20); // NTPN
                    $sheet->getDelegate()->getColumnDimension('L')->setWidth(18); // Tanggal Bayar

                    // Mengaktifkan wrap text
                    $sheet->getDelegate()->getStyle('A1:L1000')
                        ->getAlignment()->setWrapText(true);

                    // Merge cells untuk judul utama, subjudul, dan header bertingkat
                    $sheet->mergeCells('A1:L1'); // PEMERINTAH KABUPATEN TABALONG
                    $sheet->mergeCells('A2:L2'); // (nama instansi)
                    $sheet->mergeCells('A3:A4'); // No
                    $sheet->mergeCells('B3:B4'); // Instansi
                    $sheet->mergeCells('C3:D3'); // SP2D
                    $sheet->mergeCells('E3:H3'); // POTONGAN PAJAK & DEDUCTION
                    $sheet->mergeCells('I3:I4'); // NPWP BENDAHARA/REKANAN
                    $sheet->mergeCells('J3:J4'); // NAMA BENDAHARA/REKANAN
                    $sheet->mergeCells('K3:K4'); // NTPN
                    $sheet->mergeCells('L3:L4'); // TANGGAL BAYAR

                    // Mengatur alignment
                    $sheet->getDelegate()->getStyle('A3:L5')->getAlignment()->setHorizontal('center');
                    $sheet->getDelegate()->getStyle('A3:L5')->getAlignment()->setVertical('center');

                    // Border untuk header
                    $sheet->getDelegate()->getStyle('A3:L5')->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                    // Styling untuk header
                    $sheet->getDelegate()->getStyle('A1:L5')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'name' => 'Times New Roman',
                            'size' => 12,
                        ],
                    ]);
                    $sheet->getDelegate()->getStyle('A6:L1000')->applyFromArray([
                        'font' => [
                            'name' => 'Times New Roman',
                            'size' => 12,
                        ],
                    ]);
                },
            ];
        }
    }
}
