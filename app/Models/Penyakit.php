<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'penyebab',
        'pencegahan',
        'solusi'
    ];

    // Semua gejala
    public function gejala()
    {
        return $this->belongsToMany(
            Gejala::class,
            'rules',
            'penyakit_id',
            'gejala_id'
        );
    }


    public function rules()
    {
        return $this->hasMany(Rules::class);
    }

}