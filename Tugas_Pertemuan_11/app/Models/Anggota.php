<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'kode',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at'    => 'datetime',
    ];

    // ACCESSORS
    /**
     * @return string
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->status === 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }

        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * Accessor: Kategori usia anggota berdasarkan tanggal lahir
     * @return string
     */
    public function getKategoriUsiaAttribute(): string
    {
        if (! $this->tanggal_lahir) {
            return 'Tidak Diketahui';
        }

        $umur = Carbon::parse($this->tanggal_lahir)->age;

        if ($umur < 20) {
            return 'Remaja';
        } elseif ($umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    // SCOPES
    /**
     * Scope: Filter anggota berdasarkan jenis kelamin
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $jk  'L' untuk Laki-laki, 'P' untuk Perempuan
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJenisKelamin($query, string $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    /**
     * Scope: Filter anggota yang terdaftar di bulan dan tahun ini.
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereYear('created_at', Carbon::now()->year)
                     ->whereMonth('created_at', Carbon::now()->month);
    }
}
