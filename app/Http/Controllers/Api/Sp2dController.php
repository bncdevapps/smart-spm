<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sp2dResource;
use App\Models\Instansi;
use App\Models\Spm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sp2dController extends Controller
{
    public function sp2d(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'instansi'     => 'required|string',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return new Sp2dResource(false, $validator->errors(), '');
                // return response()->json($validator->errors(), 422);
            }

            $ctt = 'Semua Data SP2D';
            $query = Spm::select([
                'instansi',
                'nomor_sp2d',
                'jumlah',
                'kode_akun_pajak',
                'kode_jenis_setoran_pajak',

                'ppn',
                'pajak_lain',
                'jumlah_pajak_lain',
                'npwp_bendahara',
                'penyedia',
                'ntpn',
                'id_biling_pajak',
                'tanggal_bayar_pajak',
            ]);

            if ($request->instansi != 'semua') {
                $query->where('instansi', $request->instansi);
                $ctt = $request->instansi . ' semua data SP2D';
            }

            $query->where('status_ajukan', 'sp2d terbit');
            $sp2d = $query->latest()->paginate(5);

            //return collection of posts as a resource
            return new Sp2dResource(true, $ctt, $sp2d);
        } catch (\Throwable $th) {
            // return new Sp2dResource(false, $th->getMessage(), '');
            return new Sp2dResource(false, 'terjadi kesalahan', '');
        }
    }
    public function instansi()
    {
        try {
            //get all posts
            $instansi = Instansi::select(['nama', 'keterangan'])->latest()->get();
            // $instansi = Instansi::select(['nama', 'keterangan'])->latest()->paginate(5);
            // $instansi['data']['data']['nama'] = 'semua';
            // $instansi['data']['data']['keterangan'] = 'semua';
            //return collection of posts as a resource
            return new Sp2dResource(true, 'semua data instansi', $instansi);
        } catch (\Throwable $th) {
            return new Sp2dResource(false, 'terjadi kesalahan', '');
            // return new Sp2dResource(false, $th->getMessage(), '');
        }
    }
}
