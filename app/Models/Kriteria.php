<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = "kriteria";
    protected $primaryKey = "id";
    public $incrementing = "true";
    // protected $keyType = "string";
    public $timestamps = "true";
    protected $fillable = [
        "kode",
        "nama",
        "bobot",
        "tipe",
    ];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'kriteria_id');
    }
}
