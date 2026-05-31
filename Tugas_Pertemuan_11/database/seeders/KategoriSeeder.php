<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi'     => 'Buku-buku tentang pemrograman komputer, algoritma, dan pengembangan perangkat lunak.',
                'icon'          => 'code-slash',
                'warna'         => 'primary',
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi'     => 'Buku-buku tentang desain, pengelolaan, dan optimasi basis data.',
                'icon'          => 'database',
                'warna'         => 'success',
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi'     => 'Buku-buku tentang desain antarmuka web, UI/UX, dan pengembangan frontend.',
                'icon'          => 'palette',
                'warna'         => 'info',
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi'     => 'Buku-buku tentang jaringan komputer, protokol, dan infrastruktur IT.',
                'icon'          => 'wifi',
                'warna'         => 'warning',
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi'     => 'Buku-buku tentang analisis data, machine learning, dan kecerdasan buatan.',
                'icon'          => 'graph-up',
                'warna'         => 'danger',
            ],
        ];

        foreach ($kategoriData as $data) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $data['nama_kategori']],
                $data
            );
        }

        $this->command->info('Seeder KategoriSeeder berhasil dijalankan! ' . count($kategoriData) . ' data kategori ditambahkan.');
    }
}
