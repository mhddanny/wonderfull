<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Customer extends Authenticatable
{
    // protected $date = [ 'created_at' ];
    // protected $table = 'customers';
    // protected $fillable = [
    //   'nama_customer',
    //   'ktp',
    //   'no_hp',
    //   'alamat',
    //   'user_id',
    //   'is_aktif'
    // ];
    use Notifiable;
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
