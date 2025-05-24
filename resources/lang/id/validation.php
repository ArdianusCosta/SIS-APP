<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */
    'confirmed' => ':attribute tidak cocok dengan konfirmasi.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'min' => [
        'string' => ':attribute harus memiliki panjang minimal :min karakter.',
    ],
    'unique' => ':attribute sudah digunakan.',
    'required' => ':attribute wajib diisi.',
    'mimes' => ':attribute harus berupa file dengan tipe: :values.',
    'max' => [
        'file' => ':attribute tidak boleh lebih besar dari :max kilobyte.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'name' => 'Nama',
        'email' => 'Email',
        'photo' => 'Foto Profil',
        'old_password' => 'Password Lama',
        'new_password' => 'Password Baru',
        'new_password_confirmation' => 'Konfirmasi Password Baru',
    ],
];