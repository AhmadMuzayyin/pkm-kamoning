<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $guarded = ['id'];

    public function resep()
    {
        return $this->hasMany(Resep::class, 'obat_id');
    }
}
