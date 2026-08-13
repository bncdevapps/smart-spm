<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan kesalahan standar yang digunakan oleh
    | kelas validator. Beberapa aturan memiliki beberapa versi seperti aturan
    | ukuran. Silakan sesuaikan setiap pesan di sini.
    |
    */

    'accepted' => ':attribute harus diterima.',
    'accepted_if' => ':attribute harus diterima ketika :other bernilai :value.',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berupa sebuah array.',
    'before' => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => ':attribute harus memiliki antara :min dan :max item.',
        'file' => ':attribute harus berukuran antara :min hingga :max kilobita.',
        'numeric' => ':attribute harus bernilai antara :min hingga :max.',
        'string' => ':attribute harus berisi antara :min hingga :max karakter.',
    ],
    'boolean' => ':attribute harus bernilai benar atau salah.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Password tidak sesuai.',
    'date' => ':attribute harus berupa tanggal yang valid.',
    'date_equals' => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak cocok dengan format :format.',
    'declined' => ':attribute harus ditolak.',
    'declined_if' => ':attribute harus ditolak ketika :other bernilai :value.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus terdiri dari :digits digit.',
    'digits_between' => ':attribute harus terdiri dari :min hingga :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':attribute memiliki nilai duplikat.',
    'doesnt_end_with' => ':attribute tidak boleh diakhiri dengan salah satu dari: :values.',
    'doesnt_start_with' => ':attribute tidak boleh diawali dengan salah satu dari: :values.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari: :values.',
    'enum' => ':attribute yang dipilih tidak valid.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berupa sebuah berkas.',
    'filled' => ':attribute wajib diisi.',
    'gt' => [
        'array' => ':attribute harus memiliki lebih dari :value item.',
        'file' => ':attribute harus berukuran lebih besar dari :value kilobita.',
        'numeric' => ':attribute harus bernilai lebih besar dari :value.',
        'string' => ':attribute harus berisi lebih dari :value karakter.',
    ],
    'gte' => [
        'array' => ':attribute harus memiliki :value item atau lebih.',
        'file' => ':attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus bernilai lebih besar dari atau sama dengan :value.',
        'string' => ':attribute harus berisi lebih dari atau sama dengan :value karakter.',
    ],
    'image' => ':attribute harus berupa gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute tidak ada di dalam :other.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'ip' => ':attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => ':attribute harus berupa alamat IPv6 yang valid.',
    'json' => ':attribute harus berupa string JSON yang valid.',
    'lt' => [
        'array' => ':attribute harus memiliki kurang dari :value item.',
        'file' => ':attribute harus berukuran kurang dari :value kilobita.',
        'numeric' => ':attribute harus bernilai kurang dari :value.',
        'string' => ':attribute harus berisi kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => ':attribute tidak boleh memiliki lebih dari :value item.',
        'file' => ':attribute harus berukuran kurang dari atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus bernilai kurang dari atau sama dengan :value.',
        'string' => ':attribute harus berisi kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => ':attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => ':attribute tidak boleh memiliki lebih dari :max item.',
        'file' => 'Ukuran :attribute tidak boleh lebih dari :max kilobita.',
        'numeric' => ':attribute tidak boleh lebih besar dari :max.',
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
    ],
    'max_digits' => ':attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => ':attribute harus berupa berkas berformat: :values.',
    'mimetypes' => ':attribute harus berupa berkas berformat: :values.',
    'min' => [
        'array' => ':attribute harus memiliki minimal :min item.',
        'file' => 'Ukuran :attribute minimal :min kilobita.',
        'numeric' => ':attribute minimal harus bernilai :min.',
        'string' => ':attribute minimal harus berisi :min karakter.',
    ],
    'min_digits' => ':attribute harus memiliki minimal :min digit.',
    'multiple_of' => ':attribute harus merupakan kelipatan dari :value.',
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'password' => [
        'letters' => ':attribute harus mengandung setidaknya satu huruf.',
        'mixed' => ':attribute harus mengandung setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers' => ':attribute harus mengandung setidaknya satu angka.',
        'symbols' => ':attribute harus mengandung setidaknya satu simbol khusus.',
        'uncompromised' => ':attribute yang dimasukkan telah muncul dalam kebocoran data. Silakan pilih :attribute yang lain.',
    ],
    'present' => ':attribute harus ada.',
    'prohibited' => ':attribute tidak diperbolehkan.',
    'prohibited_if' => ':attribute tidak diperbolehkan ketika :other bernilai :value.',
    'prohibited_unless' => ':attribute tidak diperbolehkan kecuali :other ada di dalam :values.',
    'prohibits' => ':attribute melarang :other untuk ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => ':attribute wajib diisi.',
    'required_array_keys' => ':attribute harus berisi entri untuk: :values.',
    'required_if' => ':attribute wajib diisi ketika :other bernilai :value.',
    'required_unless' => ':attribute wajib diisi kecuali :other ada di dalam :values.',
    'required_with' => ':attribute wajib diisi jika :values ada.',
    'required_with_all' => ':attribute wajib diisi jika :values ada.',
    'required_without' => ':attribute wajib diisi jika :values tidak ada.',
    'required_without_all' => ':attribute wajib diisi jika tidak ada satu pun dari :values yang ada.',
    'same' => ':attribute dan :other harus cocok.',
    'size' => [
        'array' => ':attribute harus berisi :size item.',
        'file' => 'Ukuran :attribute harus :size kilobita.',
        'numeric' => ':attribute harus bernilai :size.',
        'string' => ':attribute harus berisi :size karakter.',
    ],
    'starts_with' => ':attribute harus diawali dengan salah satu dari: :values.',
    'string' => ':attribute harus berupa teks.',
    'timezone' => ':attribute harus berupa zona waktu yang valid.',
    'unique' => ':attribute sudah terdaftar.',
    'uploaded' => 'Gagal mengunggah :attribute.',
    'url' => 'Format :attribute tidak valid.',
    'uuid' => ':attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Pesan Validasi Kustom
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'email' => [
            'required' => 'Alamat email atau username wajib diisi.',
        ],
        'password' => [
            'required' => 'Password wajib diisi.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name' => 'Nama',
        'username' => 'NIP Pegawai / Username',
        'email' => 'Alamat Email',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
        'current_password' => 'Password Saat Ini',
        'nama' => 'Nama',
        'tanggal' => 'Tanggal SPM',
        'nomor' => 'Nomor SPM',
        'jenis' => 'Jenis SPM',
        'jumlah' => 'Jumlah SPM (Bruto)',
        'penyedia' => 'Nama Pihak Ketiga/Penyedia',
        'keperluan' => 'Keperluan',
        'keterangan' => 'Keterangan',
        'alamat' => 'Alamat',
        'npwp' => 'NPWP',
        'nama_bank' => 'Nama Bank',
        'nama_rekening' => 'Nama Rekening',
        'nomor_rekening' => 'Nomor Rekening',
        'name_instansi' => 'Nama Instansi',
        'otorisasi' => 'Hak Akses / Otorisasi',
        'ppn' => 'PPN',
        'id_biling_ppn' => 'ID Billing PPN',
        'id_biling_pajak' => 'ID Billing Pajak',
        'npwp_bendahara' => 'NPWP Bendahara/Rekanan',
        'kode_akun_pajak' => 'Kode Akun Pajak',
        'kode_jenis_setoran_pajak' => 'Kode Jenis Setoran Pajak',
        'jumlah_netto' => 'Jumlah SPM (Netto)',
        'jumlah_potongan' => 'Jumlah Potongan',
        'jumlah_pajak_lain' => 'Jumlah Pajak Lainnya',
        'dokumen' => 'Dokumen Lampiran',
        'dokumen.*' => 'Berkas Lampiran',
        'newDokumenUpload.*' => 'Berkas Lampiran',
        'pajak_lain_items.*.jenis' => 'Jenis Pajak Lainnya',
        'pajak_lain_items.*.jumlah' => 'Nominal Pajak Lainnya',
        'pajak_lain_items.*.id_biling' => 'ID Billing Pajak Lainnya',
        'potongan_items.*.jenis' => 'Jenis Potongan',
        'potongan_items.*.jumlah' => 'Nominal Potongan',
        'potongan_items.*.id_biling' => 'ID Billing Potongan',
    ],

];
