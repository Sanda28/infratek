<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LampiranPengajuan extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'pengajuan_id',
        'nama_file',
        'path_file',
        'tipe',
        'catatan',
    ];

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
