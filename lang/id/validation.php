<?php

return [
    'required' => 'Kolom :attribute wajib diisi.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'string' => 'Kolom :attribute harus berupa teks.',
    
    'custom' => [
        'email' => [
            'required' => 'Email atau username tidak boleh kosong.',
        ],
        'password' => [
            'required' => 'Password tidak boleh kosong.',
        ],
    ],

    'attributes' => [
        'email' => 'email / username',
        'password' => 'password',
    ],
];
