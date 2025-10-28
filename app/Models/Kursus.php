<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kursus extends Model
{
    protected $table = 'kursus';
    protected $primaryKey = 'id_kursus';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'instruktur_id',
        'judul',
        'deskripsi',
        'durasi',
        'hari',
        'gambar'
    ];
    
    public $timestamps = true;

    public function instruktur(): BelongsTo{
        return $this->belongsTo(Instruktur::class, 'instruktur_id', 'id_instruktur');
    }

    public function peserta(): BelongsToMany{
        return $this->belongsToMany(Peserta::class, 'peserta_kursus', 'kursus_id', 'peserta_id')
        ->withPivot('status')
        ->withTimestamps();
    }

    public function pesertaKursus(): HasMany{
        return $this->hasMany(PesertaKursus::class, 'kursus_id', 'id_kursus');
    }
}
