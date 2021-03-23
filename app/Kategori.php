<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    protected $date = [ 'created_at' ];
    protected $table = 'kategori';
    protected $primaryKey = 'kd_kategori';
    protected $fillable = [
        'kategori',
        'parent_id',
        'slug',
        'gambar_kategori'
    ];

    public function produk()
    {
      return $this->hasMany('App\Produk','kd_produk');
    }

    //INI ADALAH METHOD UNTUK MENG-HANDLE RELATIONSHIPS
    public function parent()
    {
        //KARENA RELASINYA DENGAN DIRINYA SENDIRI, MAKA CLASS MODEL DIDALM belongsTo() ADALAH NAMA CLASSNYA SENDIRI YAKNI CATEGORY
        //belongsTo DIGUNAKAN UNTUK REFLEKSI KE DATA INDUKNYA
        return $this->belongsTo(Kategori::class);
    }

    //UNTUK LOCAL SCOPE NAMA METHODNYA DIAWAL DENGAN KATA scope DAN DIIKUTI DENGAN NAMA METHOD YANG DIINGINKAN
    //CONTOH: scopeNamaMethod()
    public function scopeGetParent($query)
    {
        //SEMUA QUERY YANG MENGGUNAKAN LOCAL SCOPE INI AKAN SECARA OTOMATIS DITAMBAHKAN KONDISI whereNul('parent_id')
        return $query->whereNull('parent_id');
    }
    //MUTATOR
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    //ACCESSOR
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function child()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY parent_id
        return $this->hasMany(Kategori::class, 'parent_id');
    }
}
