<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $guarded = ['id'];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class, 'pendaftaran_id');
    }
    public function resep()
    {
        return $this->hasMany(Resep::class, 'pendaftaran_id');
    }
    public function tindakan()
    {
        return $this->hasOne(Tindakan::class, 'pendaftaran_id');
    }
    public function fisik()
    {
        return $this->hasOne(Fisik::class, 'pendaftaran_id');
    }
}
