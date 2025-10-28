<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaKursus extends Model
{
    protected $table = 'peserta_kursus';
    protected $primaryKey = 'id_peserta_kursus';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kursus_id',
        'peserta_id',
        'status',
    ];

    public $timestamps = true;

    public function kursus(): BelongsTo
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'id_kursus');
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'id_peserta');
    }
}
