<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    protected $table            = 'diskon';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'nominal'];
    protected $useTimestamps    = true;

    // Jika ingin otomatis validasi saat save()
    protected $validationRules = [
        'id' => 'permit_empty', // Tambahkan ini
        'tanggal' => 'required|is_unique[diskon.tanggal,id,{id}]',
        'nominal' => 'required|integer|min_length[1]',
    ];

    protected $validationMessages = [
        'tanggal' => [
            'required'  => 'Tanggal diskon wajib diisi.',
            'is_unique' => 'Tanggal diskon sudah ada.',
        ],
        'nominal' => [
            'required'   => 'Nominal diskon wajib diisi.',
            'integer'    => 'Nominal diskon harus berupa angka.',
            'min_length' => 'Nominal diskon tidak boleh kosong.',
        ],
    ];

    // Optional: untuk memvalidasi data sebelum simpan
    protected $skipValidation = true;
}
