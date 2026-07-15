<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';
    protected $fillable = [
    'user_id',
    'tanggal',
    'status',
    'penyakit_id',
    'persentase',
    'kemungkinan_lain',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penyakit()
    {
    return $this->belongsTo(Penyakit::class);
    }

    public function detail()
    {
        return $this->hasMany(
            DetailKonsultasi::class,
            'konsultasi_id'
        );
    }

}