<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    protected $table = 'rules';
    protected $fillable = [
    'kode',
    'penyakit_id',
    'gejala_id',
    'cf_pakar'
];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}