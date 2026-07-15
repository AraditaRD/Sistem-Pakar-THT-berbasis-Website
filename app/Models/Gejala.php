<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejala';
    protected $fillable = ['kode', 'nama', 'kategori', 'deskripsi'];

    public function penyakit()
    {
        return $this->belongsToMany(Penyakit::class, 'rules', 'gejala_id', 'penyakit_id');
    }

    public function rules()
    {
        return $this->hasMany(Rules::class);
    }
}