<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'kd_produk';
    protected $fillable = [
      'kd_kategori',
      'nama_produk',
      'kode',
      'harga',
      'weight',
      'ket',
      'gambar_produk',
      'stok'
    ];

    public function kategori()
    {
      return $this->belongsTo('App\Kategori','kd_kategori');
    }

    public function getPriceAttribute($value)
    {
      $newForm = "Rp".$value;
      return $newForm;
    }
}
