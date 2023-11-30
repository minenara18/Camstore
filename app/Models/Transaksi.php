<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable =[
        'barang_id', 'jumlah'
    ];


    public function products()
    {
        return $this->belongsTo(product::class, 'barang_id', 'id');
    }
}
