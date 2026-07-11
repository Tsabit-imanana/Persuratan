<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KetuaRt extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ketua_rt';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nik',
        'rt',
        'rw',
        'no_whatsapp',
    ];

    /**
     * Get the surat pengantar RT records for the Ketua RT.
     */
    public function suratPengantarRt(): HasMany
    {
        return $this->hasMany(SuratPengantarRt::class, 'rt_id');
    }

    /**
     * Get the surat pengantar kelurahan records for the Ketua RT.
     */
    public function suratPengantarKelurahan(): HasMany
    {
        return $this->hasMany(SuratPengantarKelurahan::class, 'rt_id');
    }
}
