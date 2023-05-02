<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomModel extends Model
{
    use HasFactory;
    protected $table = "t_bom";
    protected $primaryKey = 'kode_bom';
    public $incrementing = false;
    protected $fillable = ['kode_bom','kode_produk','tanggal','total_harga'];
    public $timestamps = false;
}
