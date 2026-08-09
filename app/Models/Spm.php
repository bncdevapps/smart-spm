<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Spm extends Model
{
    //
    protected $guarded = [];

    protected $appends = ['dokumen_list'];

    protected $casts = [
        'tanggal' => 'datetime',
        'tanggal_bayar_pajak' => 'datetime',
        'pajak_lain_items' => 'array',
        'potongan_items' => 'array',
    ];

    private function cleanMoney($value)
    {
        if (is_null($value) || $value === '') {
            return 0;
        }
        if (is_int($value) || is_float($value)) {
            return $value;
        }
        $clean = preg_replace('/[^\d]/', '', (string) $value);
        return $clean === '' ? 0 : (float) $clean;
    }

    public function setJumlahAttribute($value)
    {
        $this->attributes['jumlah'] = $this->cleanMoney($value);
    }
    public function setPpnAttribute($value)
    {
        $this->attributes['ppn'] = $this->cleanMoney($value);
    }
    public function setJumlahPajakLainAttribute($value)
    {
        $this->attributes['jumlah_pajak_lain'] = $this->cleanMoney($value);
    }
    public function setJumlahPotonganAttribute($value)
    {
        $this->attributes['jumlah_potongan'] = $this->cleanMoney($value);
    }
    public function setJumlahNettoAttribute($value)
    {
        $this->attributes['jumlah_netto'] = $this->cleanMoney($value);
    }

    /**
     * Accessor to get standard array of documents
     * Compatible with both new JSON array format and legacy single filename string
     */
    public function getDokumenListAttribute()
    {
        $val = $this->dokumen;
        if (empty($val)) {
            return [];
        }

        if (is_array($val)) {
            return $val;
        }

        if (is_string($val)) {
            $decoded = json_decode($val, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }

            // Legacy single file format
            return [
                [
                    'file' => $val,
                    'nama' => 'Dokumen Lampiran SPM (' . ($this->nomor ?? 'Berkas') . ').pdf',
                    'size' => null,
                ]
            ];
        }

        return [];
    }
}
