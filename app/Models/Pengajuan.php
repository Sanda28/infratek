<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengajuan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'menara_baru_data' => 'array',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function menara(): BelongsTo
    {
        return $this->belongsTo(Menara::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranPengajuan::class);
    }

    public function logStatus(): HasMany
    {
        return $this->hasMany(LogStatusPengajuan::class);
    }
}
