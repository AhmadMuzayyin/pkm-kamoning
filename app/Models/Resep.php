<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $guarded = ['id'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
