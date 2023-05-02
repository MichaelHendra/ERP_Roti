<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = "t_produk";
    protected $primaryKey = 'kode_produk';
    public $incrementing = false;
    protected $fillable = ['kode_produk', 'nama_produk', 'deskripsi',
        'gambar', 'qty', 'harga', 'status'
    ];
    public $timestamps = false;
}
