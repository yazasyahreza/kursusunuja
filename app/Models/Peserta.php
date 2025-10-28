<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'no_telepon',
        'alamat',
        'jenis_kelamin',
    ];

    public $timestamps = true;

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function kursus(): BelongsToMany{
        return $this->belongsToMany(Kursus::class, 'peserta_kursus', 'peserta_id', 'kursus_id')
        ->withPivot('status')
        ->withTimestamps();
    }

    public function pesertaKursus(): HasMany{
        return $this->hasMany(PesertaKursus::class, 'peserta_id', 'id_peserta');
    }
}
