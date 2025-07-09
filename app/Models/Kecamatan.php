<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $fillable = ['kode', 'nama', 'geojson', 'warna'];

    public function desas()
    {
        return $this->hasMany(Desa::class);
    }
}
