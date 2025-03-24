<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        $penjualan_ids = DB::table('t_penjualan')->pluck('penjualan_id'); //Mengammbil semua id penjualan
        $barang_ids = DB::table('m_barang')->pluck('barang_id'); //Mengammbil semua id barang
        
        $data = [];
        $detail_id = 1; //memulai detail_id dari urutan 1
        
        foreach ($penjualan_ids as $penjualan_id) {
            // Ambil acak 3 barang  utuk setiap transaksi
            $barang_acak = $barang_ids->shuffle()->take(3);
            
            foreach ($barang_acak as $barang_id) {
                $harga = rand(10000, 50000); // Harga acak antara 10.000 - 50.000
                $jumlah = rand(1, 5); // Jumlah barang antara 1 - 5
                
                $data[] = [
                    'detail_id' => $detail_id++, // Auto-increment manual
                    'penjualan_id' => $penjualan_id,
                    'barang_id' => $barang_id,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                ];
            }
        }

        // Insert data ke tabel `t_penjualan_detail`
        DB::table('t_penjualan_detail')->insert($data);
    }
}