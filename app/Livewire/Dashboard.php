<?php

namespace App\Livewire;

use App\Models\Spm;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $totalSpm = 0;
    public $totalPerbaikanSpm = 0;
    public $totalSp2dTerbit = 0;
    public $totalSpmDitolak = 0;

    public $nominalTotalSpm = 0;
    public $nominalPerbaikanSpm = 0;
    public $nominalSp2dTerbit = 0;
    public $nominalSpmDitolak = 0;
    public $recentSpms = [];

    public function mount()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->otorisasi === 'ppk') {
            return $this->redirect(route('daftar-spm-review', ['kode' => 0]), navigate: true);
        } elseif ($user->otorisasi === 'verifikator') {
            return $this->redirect(route('daftar-spm-review', ['kode' => 1]), navigate: true);
        } elseif ($user->otorisasi === 'admin') {
            return $this->redirect(route('daftar-spm-review', ['kode' => 3]), navigate: true);
        }

        $this->calculateStatistics();
    }

    public function calculateStatistics()
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }

        $userInstansi = $user->name_instansi;

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
        return view('livewire.dashboard');
    }
}
