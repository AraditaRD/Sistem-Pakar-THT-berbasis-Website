<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKonsultasi extends Model
{
    protected $table = 'detail_konsultasi';
    protected $fillable=[
    'konsultasi_id',
    'gejala_id',
    'jawaban',
    'cf_user'
];

    public function gejala()
    {
        return $this->belongsTo(
            Gejala::class,
            'gejala_id'
        );
    }
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }
}