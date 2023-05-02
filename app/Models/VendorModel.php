<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    use HasFactory;
    protected $table = 't_vendor';
    protected $primaryKey = 'id_vendor';
    public $incrementing = false;
    protected $fillable = ['id_vendor', 'nama_vendor', 'telpon', 'alamat', 'status'
    ];
    public $timestamps = false;
}
