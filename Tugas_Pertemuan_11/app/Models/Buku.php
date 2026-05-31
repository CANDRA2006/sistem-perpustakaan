<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'harga',
        'stok',
        'deskripsi',
        'kategori_id',
    ];

    protected $casts = [
        'harga'       => 'integer',
        'stok'        => 'integer',
        'tahun_terbit' => 'integer',
    ];

    // ACCESSORS
    /**
     * @return string
     */
    public function getStatusStokBadgeAttribute(): string
    {
        $stok = $this->stok ?? 0;

        if ($stok === 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($stok <= 5) {
            return '<span class="badge bg-warning text-dark">Menipis</span>';
        } elseif ($stok <= 15) {
            return '<span class="badge bg-info text-dark">Sedang</span>';
        } else {
            return '<span class="badge bg-success">Aman</span>';
        }
    }

    /**
     * Accessor: Label tahun buku.
     * @return string
     */
    public function getTahunLabelAttribute(): string
    {
        $tahun = $this->tahun_terbit ?? 0;

        return $tahun >= 2024 ? 'Buku Baru' : 'Buku Lama';
    }

    // SCOPES
    /**
     * Scope: Filter buku dengan stok < 5 (stok menipis)
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    /**
     * Scope: Filter buku berdasarkan rentang harga.
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $min
     * @param  int  $max
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHargaRange($query, int $min, int $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    /**
     * Scope: Filter buku terbaru (tahun_terbit >= 2024).
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}
