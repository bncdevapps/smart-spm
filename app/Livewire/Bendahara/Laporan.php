<?php

namespace App\Livewire\Bendahara;

use App\Models\Spm;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SpmExport;
use App\Models\Instansi;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Laporan extends Component
{

    use LivewireAlert;

    public $dari_tanggal = '';
    public $sampai_tanggal = '';
    public $status = 'semua';
    public $instansi = '';
    public $filter_penyedia = 'semua';
    public $preview = false;
    public $spms = [];
    public $kode;
    public $nama;

    public function viewPreview()
    {
        $rules = [
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ];

        if ($this->kode == 1) {
            $rules['status'] = 'required|string';
        }

        if (Auth()->user()->otorisasi == 'admin') {
            $rules['instansi'] = 'required|string';
        }

        $this->validate($rules);

        try {
            $this->preview = true;
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
            $this->spms = $query->get()->toArray();
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }
    public function exportExcel()
    {
        $rules = [
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ];

        $namaFile = "SP2D-";
        if ($this->kode == 1) {
            $rules['status'] = 'required|string';
            $namaFile = "SPM-";
        }

        if (Auth()->user()->otorisasi === 'admin') {
            $rules['instansi'] = 'required|string';
        }

        $this->validate($rules);

        try {
            return Excel::download(new SpmExport($this->kode, $this->instansi, $this->dari_tanggal, $this->sampai_tanggal, $this->status, $this->filter_penyedia), $namaFile . $this->status . '-' . $this->dari_tanggal . '-sd-' . $this->sampai_tanggal . '.xlsx');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function exportPdf()
    {
        $rules = [
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ];

        $namaFile = "SP2D-";
        if ($this->kode == 1) {
            $rules['status'] = 'required|string';
            $namaFile = "SPM-";
        }

        if (Auth()->user()->otorisasi === 'admin') {
            $rules['instansi'] = 'required|string';
        }

        $this->validate($rules);

        try {
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

            $spms = $query->get();
            $kode = $this->kode;
            $pdf = Pdf::loadView('exports.spm-pdf', compact(['spms', 'kode']))->setPaper('A4', 'landscape');
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, $namaFile . $this->status . '-' . $this->dari_tanggal . '-sd-' . $this->sampai_tanggal . '.pdf');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function lembarPenguji()
    {
        echo'oke';        
    }
    
    public function mount($kode)
    {
        $this->kode = $kode;
    }
    public function render()
    {
        if ($this->kode == 1) {
            $this->nama = "Laporan Register SPM";
        } elseif ($this->kode == 2) {
            $this->nama = "Laporan Register SP2D";
        } else {
            abort(403, 'Unauthorized');
        }

        $instansi = Instansi::orderBy('nama', 'asc')->get();
        $penyedias = \App\Models\Penyedia::orderBy('nama', 'asc')->get();

        return view('livewire.bendahara.laporan', [
            'instansis' => $instansi,
            'penyedias' => $penyedias,
        ]);
    }
}
