<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instruktur extends Model
{
    protected $table = 'instruktur';
    protected $primaryKey = 'id_instruktur';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'bidang_keahlian',
        'no_telepon',
        'jenis_kelamin'
    ];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function kursus(): HasMany
    {
        return $this->hasMany(Kursus::class, 'instruktur_id', 'id_instruktur');
    }
}
