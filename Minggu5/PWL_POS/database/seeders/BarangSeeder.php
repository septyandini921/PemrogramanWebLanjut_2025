<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            //1 pakaian, 2 elektronik, makanan, minuman, perabotan
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Kemeja Katun', 'harga_beli' => 70000, 'harga_jual' => 75000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 80000, 'harga_jual' => 85000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'BRG003', 'barang_nama' => 'Blender', 'harga_beli' => 200000, 'harga_jual' => 205000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'Televisi', 'harga_beli' => 700000, 'harga_jual' => 705000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'BRG005', 'barang_nama' => 'Mi Instan', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'BRG006', 'barang_nama' => 'Roti Tawar', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'BRG007', 'barang_nama' => 'Air Mineral', 'harga_beli' => 5000, 'harga_jual' => 6000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'BRG008', 'barang_nama' => 'Teh Manis', 'harga_beli' => 5000, 'harga_jual' => 6000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'BRG009', 'barang_nama' => 'Gayung', 'harga_beli' => 5000, 'harga_jual' => 6000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'BRG010', 'barang_nama' => 'Kemoceng', 'harga_beli' => 7000, 'harga_jual' => 9000],
            
        ];

        DB::table('m_barang')->insert($data);
    }
}
