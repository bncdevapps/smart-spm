<?php

namespace App\Livewire\Bendahara;

use App\Exports\LembarPengujiExport;
use App\Models\Spm;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SpmExport;
use App\Models\Instansi;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LaporanLembarPenguji extends Component
{

    use LivewireAlert;

    public $tanggal = '';
    public $tanggal_cetak = '';
    public $instansi = '';
    public $preview = false;
    public $spms = [];


     public function viewPreview()
    {
        $rules = [
            'tanggal' => 'required|date',
            'tanggal_cetak' => 'required|date',
            'instansi' => 'required|string',
        ];

        $this->validate($rules);
        try {
            $this->preview = true;
            $query = Spm::select();
            $query->where('status_ajukan', 'sp2d terbit');
            if ($this->instansi !== 'semua') {
                $query->where('instansi', $this->instansi);  
            }             
            $query->where('tanggal', $this->tanggal);
            // dd($query->get());
            $this->spms = $query->get()->toArray();
//             $this->spms = $query->get()->map(function ($item) {
//                 $item->tanggal_cetak = $this->tanggal_cetak;
//                 return $item;
//             })->toArray();
// dd($this->spms);

        } catch (\Throwable $th) {        
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function exportExcel()
    {
        $rules = [
            'tanggal' => 'required|date',
            'tanggal_cetak' => 'required|date',
            'instansi' => 'required|string',
        ];

        $this->validate($rules);

        try {
            return Excel::download(new LembarPengujiExport($this->instansi, $this->tanggal, Carbon::parse($this->tanggal_cetak)->format('d M Y')),  'lembar-penguji-' . $this->instansi . '-' . $this->tanggal  .  '.xlsx');
            // $this->alert('error', 'Status SPM Belum Dipilih.');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Export Excel Lembar Penguji Error: ' . $th->getMessage());
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function exportPdf()
    {

        $rules = [
            'tanggal' => 'required|date',
            'tanggal_cetak' => 'required|date',
            'instansi' => 'required|string',
        ];

        $this->validate($rules);


        try {

            $query = Spm::select();

            $query->where('status_ajukan', 'sp2d terbit');
            if ($this->instansi !== 'semua') {
                $query->where('instansi', $this->instansi);  
            }             
            $query->where('tanggal', $this->tanggal);
            $tanggal_cetak = Carbon::parse($this->tanggal_cetak)->format('d M Y');
            $spms = $query->get();          
            $pdf = Pdf::loadView('exports.lembar-penguji-pdf', compact(['spms','tanggal_cetak']))->setPaper('A4', 'landscape');
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'lembar-penguji-' . $this->instansi . '-' . $this->tanggal . '.pdf');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Export PDF Lembar Penguji Error: ' . $th->getMessage());
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }



    public function render()
    {
        $instansi = Instansi::orderBy('nama', 'asc')->get();
        return view('livewire.bendahara.laporan-lembar-penguji', [
            'instansis' => $instansi,
        ]);

    }
}
