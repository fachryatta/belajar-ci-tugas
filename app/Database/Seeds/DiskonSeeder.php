<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $tanggal_awal = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

        // Pilihan nominal diskon kelipatan 50rb atau 100rb
        $nominal_diskon = [100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 500000];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'tanggal'    => date('Y-m-d', strtotime("+$i days", strtotime($tanggal_awal))),
                'nominal'    => $nominal_diskon[array_rand($nominal_diskon)],
                'created_at' => $created_at,
                'updated_at' => null,
            ];
        }

        $this->db->table('diskon')->insertBatch($data);
    }
}
