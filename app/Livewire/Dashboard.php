<?php

namespace App\Livewire;

use App\Models\Spm;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalSpm;
    public $totalPerbaikanSpm;
    public $totalSp2dTerbit;
    public $totalSpmDitolak;

    public $nominalTotalSpm = 0;
    public $nominalPerbaikanSpm = 0;
    public $nominalSp2dTerbit = 0;
    public $nominalSpmDitolak = 0;
    public $recentSpms = [];

    public function mount()
    {
        $this->calculateStatistics();
    }

    public function calculateStatistics()
    {
        $userInstansi = Auth()->user()->name_instansi;

        // Count Query
        $this->totalSpm = Spm::where('status', 'diajukan')
            ->where('status_ajukan', '!=', 'draft')
            ->where('instansi', $userInstansi)
            ->count();

        $this->totalPerbaikanSpm = Spm::where('status_ajukan', 'perlu perbaikan')
            ->where('instansi', $userInstansi)->count();

        $this->totalSp2dTerbit = Spm::where('status_ajukan', 'sp2d terbit')
            ->where('instansi', $userInstansi)->count();

        $this->totalSpmDitolak = Spm::where('status_ajukan', 'spm ditolak')
            ->where('instansi', $userInstansi)->count();

        // Nominal Sum Query
        $this->nominalTotalSpm = Spm::where('status', 'diajukan')
            ->where('status_ajukan', '!=', 'draft')
            ->where('instansi', $userInstansi)
            ->sum('jumlah_netto');

        $this->nominalPerbaikanSpm = Spm::where('status_ajukan', 'perlu perbaikan')
            ->where('instansi', $userInstansi)
            ->sum('jumlah_netto');

        $this->nominalSp2dTerbit = Spm::where('status_ajukan', 'sp2d terbit')
            ->where('instansi', $userInstansi)
            ->sum('jumlah_netto');

        $this->nominalSpmDitolak = Spm::where('status_ajukan', 'spm ditolak')
            ->where('instansi', $userInstansi)
            ->sum('jumlah_netto');

        // Recent 5 SPM
        $this->recentSpms = Spm::where('instansi', $userInstansi)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        if (Auth()->user()->otorisasi == 'ppk') {
            $this->redirectRoute('daftar-spm-review', 0);
        } elseif (Auth()->user()->otorisasi == 'verifikator') {
            $this->redirectRoute('daftar-spm-review', 1);
        } elseif (Auth()->user()->otorisasi == 'admin') {
            $this->redirectRoute('daftar-spm-review', 3);
        }
        return view('livewire.dashboard');
    }
}
