<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryModel extends Model
{
    use HasFactory;
    protected $table = 't_inventory';
    protected $primaryKey = 'id_inventory';
    protected $fillable = ['id_inventory','kode_bom','tanggal','total_harga'];
    public $timestamps = false;
}
