<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPengantarKelurahan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_pengantar_kelurahan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rt_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'alamat',
        'bukti_diri',
        'nama_orang_tua',
        'maksud_keperluan',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Get the Ketua RT that owns this surat pengantar.
     */
    public function ketuaRt(): BelongsTo
    {
        return $this->belongsTo(KetuaRt::class, 'rt_id');
    }
}
