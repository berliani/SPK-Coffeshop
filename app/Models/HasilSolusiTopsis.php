<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSolusiTopsis extends Model
{
    use HasFactory;
    protected $table = 'hasil_solusi_topsis';

    protected $fillable = ['nilai', 'alternatif_id'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}
