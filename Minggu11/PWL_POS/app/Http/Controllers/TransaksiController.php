<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetailModel extends Model
{
    use HasFactory;
    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'harga',
        'jumlah',
    ];

    // Relasi ke transaksi
    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id');
    }

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }

    public function stok()
    {
        return $this->hasOne(StokModel::class, 'barang_id', 'barang_id');
    }

}
    