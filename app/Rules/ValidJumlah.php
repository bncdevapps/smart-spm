<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

// class ValidJumlah implements ValidationRule
class ValidJumlah implements Rule
{ 
    public function passes($attribute, $value)
    {
        // Kalau kosong, anggap valid → nanti disimpan sebagai default 0
         if (is_null($value) || $value === '') {
            return true;
        }

        // Hapus titik dari angka
        $value = str_replace('.', '', $value);

        // Pastikan nilainya adalah angka valid dan >= 0
        return is_numeric($value) && $value >= 0;
    }

    public function message()
    {
        return 'Data :attribute harus berupa angka valid dan tidak minus.';
    }
}
