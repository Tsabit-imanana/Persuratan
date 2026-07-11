<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPengantarRt extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_pengantar_rt';

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
        'nik',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'alamat',
        'keperluan',
        'status',
        'catatan',
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
