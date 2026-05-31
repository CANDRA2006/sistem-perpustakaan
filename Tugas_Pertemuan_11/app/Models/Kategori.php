<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     * @var string
     */
    protected $table = 'kategori';

    /**
     * Atribut yang bisa diisi secara massal (mass assignment)
     * @var array<string>
     */
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'icon',
        'warna',
    ];
}
