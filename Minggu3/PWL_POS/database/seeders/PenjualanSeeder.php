<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Nimas', 'penjualan_kode' => 'TRX001', 'penjualan_tanggal' => '2024-01-02 10:15:00'],
            ['penjualan_id' => 2, 'user_id' => 1, 'pembeli' => 'Septian', 'penjualan_kode' => 'TRX002', 'penjualan_tanggal' => '2024-01-05 14:30:00'],
            ['penjualan_id' => 3, 'user_id' => 1, 'pembeli' => 'Dini', 'penjualan_kode' => 'TRX003', 'penjualan_tanggal' => '2024-01-07 09:45:00'],
            ['penjualan_id' => 4, 'user_id' => 1, 'pembeli' => 'Desi', 'penjualan_kode' => 'TRX004', 'penjualan_tanggal' => '2024-01-10 16:00:00'],
            ['penjualan_id' => 5, 'user_id' => 1, 'pembeli' => 'Eko', 'penjualan_kode' => 'TRX005', 'penjualan_tanggal' => '2024-01-12 11:20:00'],
            ['penjualan_id' => 6, 'user_id' => 1, 'pembeli' => 'Fajar', 'penjualan_kode' => 'TRX006', 'penjualan_tanggal' => '2024-01-15 17:10:00'],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'Galuh', 'penjualan_kode' => 'TRX007', 'penjualan_tanggal' => '2024-01-18 13:40:00'],
            ['penjualan_id' => 8, 'user_id' => 1, 'pembeli' => 'Hadi', 'penjualan_kode' => 'TRX008', 'penjualan_tanggal' => '2024-01-20 08:50:00'],
            ['penjualan_id' => 9, 'user_id' => 1, 'pembeli' => 'Cika', 'penjualan_kode' => 'TRX009', 'penjualan_tanggal' => '2024-01-25 15:05:00'],
            ['penjualan_id' => 10, 'user_id' => 1, 'pembeli' => 'Joko', 'penjualan_kode' => 'TRX010', 'penjualan_tanggal' => '2024-01-28 12:25:00'],
        ];

        // Insert data ke tabel `t_penjualan`
        DB::table('t_penjualan')->insert($data);
    }
}
