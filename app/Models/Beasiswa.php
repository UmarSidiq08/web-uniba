<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'jumlah_dana',
        'tanggal_buka',
        'tanggal_tutup',
        'status',
        'persyaratan'
    ];

    protected $dates = [
        'tanggal_buka',
        'tanggal_tutup'
    ];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function isActive()
    {
        return $this->status === 'aktif' && 
               now()->between($this->tanggal_buka, $this->tanggal_tutup);
    }
}