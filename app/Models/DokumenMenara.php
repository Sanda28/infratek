<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenMenara extends Model
{
    protected $fillable = ['menara_id', 'jenis_dokumen', 'file_path'];

    public function menara()
    {
        return $this->belongsTo(Menara::class);
    }
}
