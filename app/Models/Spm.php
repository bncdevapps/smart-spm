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

    public static function cleanDocumentName(?string $name): string
    {
        if (empty($name)) {
            return 'Dokumen Lampiran.pdf';
        }

        if (preg_match('/-meta(.+)-\.[a-zA-Z0-9]+$/i', $name, $matches)) {
            $b64 = strtr($matches[1], '-_', '+/');
            $decoded = @base64_decode($b64);
            if (!empty($decoded)) {
                return mb_convert_encoding($decoded, 'UTF-8', 'UTF-8');
            }
        }

        return $name;
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

        $list = [];

        if (is_array($val)) {
            $list = $val;
        } elseif (is_string($val)) {
            $decoded = json_decode($val, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $list = $decoded;
            } else {
                // Legacy single file format
                $list = [
                    [
                        'file' => $val,
                        'nama' => 'Dokumen Lampiran SPM (' . ($this->nomor ?? 'Berkas') . ').pdf',
                        'size' => null,
                    ]
                ];
            }
        }

        return array_map(function ($item) {
            if (is_string($item)) {
                return [
                    'file' => $item,
                    'nama' => self::cleanDocumentName($item),
                    'size' => null,
                ];
            } elseif (is_array($item)) {
                $rawName = !empty($item['nama']) ? $item['nama'] : (!empty($item['file']) ? $item['file'] : 'Dokumen.pdf');
                $item['nama'] = self::cleanDocumentName($rawName);
            }
            return $item;
        }, $list);
    }
}
