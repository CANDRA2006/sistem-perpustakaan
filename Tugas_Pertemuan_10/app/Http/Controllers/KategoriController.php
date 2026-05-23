<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Data 5 kategori buku
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Web Development',
                'deskripsi' => 'Buku tentang pengembangan website',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Database',
                'deskripsi' => 'Buku manajemen dan desain database',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'nama' => 'Mobile Development',
                'deskripsi' => 'Buku pengembangan aplikasi mobile',
                'jumlah_buku' => 20
            ],
            [
                'id' => 5,
                'nama' => 'UI/UX Design',
                'deskripsi' => 'Buku desain antarmuka dan pengalaman pengguna',
                'jumlah_buku' => 15
            ]
        ];

        return view('kategori.index', compact('kategori_list'));
    }

    public function show($id)
    {
        // Data kategori dengan daftar buku
        $kategori_data = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Web Development',
                'deskripsi' => 'Buku tentang pengembangan website',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Database',
                'deskripsi' => 'Buku manajemen dan desain database',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'nama' => 'Mobile Development',
                'deskripsi' => 'Buku pengembangan aplikasi mobile',
                'jumlah_buku' => 20
            ],
            [
                'id' => 5,
                'nama' => 'UI/UX Design',
                'deskripsi' => 'Buku desain antarmuka dan pengalaman pengguna',
                'jumlah_buku' => 15
            ]
        ];

        // Cari kategori berdasarkan id
        $kategori = null;
        foreach ($kategori_data as $kat) {
            if ($kat['id'] == $id) {
                $kategori = $kat;
                break;
            }
        }

        // Jika kategori tidak ditemukan
        if (!$kategori) {
            abort(404, 'Kategori tidak ditemukan');
        }

        // Data buku dalam kategori ini
        $buku_list = [
            ['id' => 1, 'judul' => 'Belajar PHP untuk Pemula', 'penulis' => 'Adi Nugroho', 'tahun' => 2023],
            ['id' => 2, 'judul' => 'Clean Code', 'penulis' => 'Robert C. Martin', 'tahun' => 2022],
            ['id' => 3, 'judul' => 'Design Pattern', 'penulis' => 'Gang of Four', 'tahun' => 2023],
            ['id' => 4, 'judul' => 'Algoritma dan Struktur Data', 'penulis' => 'Budi Sutisna', 'tahun' => 2021],
            ['id' => 5, 'judul' => 'Python untuk Data Science', 'penulis' => 'Widy Siswanto', 'tahun' => 2023],
        ];

        if ($id == 2) {
            $buku_list = [
                ['id' => 1, 'judul' => 'HTML5 dan CSS3', 'penulis' => 'Marco Cesare', 'tahun' => 2023],
                ['id' => 2, 'judul' => 'JavaScript Handbook', 'penulis' => 'Kyle Simpson', 'tahun' => 2022],
                ['id' => 3, 'judul' => 'React.js untuk Pemula', 'penulis' => 'Ismail Yildirim', 'tahun' => 2023],
                ['id' => 4, 'judul' => 'Vue.js Mastery', 'penulis' => 'Evan You', 'tahun' => 2023],
            ];
        } elseif ($id == 3) {
            $buku_list = [
                ['id' => 1, 'judul' => 'MySQL Handbook', 'penulis' => 'Paul DuBois', 'tahun' => 2023],
                ['id' => 2, 'judul' => 'PostgreSQL Kung Fu', 'penulis' => 'Josh Berkus', 'tahun' => 2022],
                ['id' => 3, 'judul' => 'MongoDB Guide', 'penulis' => 'Shannon Bradshaw', 'tahun' => 2023],
            ];
        } elseif ($id == 4) {
            $buku_list = [
                ['id' => 1, 'judul' => 'Android Development with Kotlin', 'penulis' => 'Emmett Etienne', 'tahun' => 2023],
                ['id' => 2, 'judul' => 'Swift for iOS', 'penulis' => 'Ray Wenderlich', 'tahun' => 2023],
                ['id' => 3, 'judul' => 'Flutter Development', 'penulis' => 'Marty Sipley', 'tahun' => 2023],
            ];
        } elseif ($id == 5) {
            $buku_list = [
                ['id' => 1, 'judul' => 'The Design of Everyday Things', 'penulis' => 'Don Norman', 'tahun' => 2023],
                ['id' => 2, 'judul' => 'UX for Developers', 'penulis' => 'Lynda Shadrake', 'tahun' => 2022],
                ['id' => 3, 'judul' => 'Wireframing and Prototyping', 'penulis' => 'Bill Scott', 'tahun' => 2023],
            ];
        }

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    public function search(Request $request, $keyword = null)
    {
        $keyword = $keyword ?? $request->input('keyword', '');

        // Data semua kategori
        $all_kategori = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Web Development',
                'deskripsi' => 'Buku tentang pengembangan website',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Database',
                'deskripsi' => 'Buku manajemen dan desain database',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'nama' => 'Mobile Development',
                'deskripsi' => 'Buku pengembangan aplikasi mobile',
                'jumlah_buku' => 20
            ],
            [
                'id' => 5,
                'nama' => 'UI/UX Design',
                'deskripsi' => 'Buku desain antarmuka dan pengalaman pengguna',
                'jumlah_buku' => 15
            ]
        ];

        // Filter kategori berdasarkan keyword
        $hasil_pencarian = [];
        $keyword_lower = strtolower($keyword);

        foreach ($all_kategori as $kategori) {
            if (
                strpos(strtolower($kategori['nama']), $keyword_lower) !== false ||
                strpos(strtolower($kategori['deskripsi']), $keyword_lower) !== false
            ) {
                $hasil_pencarian[] = $kategori;
            }
        }

        return view('kategori.search', compact('hasil_pencarian', 'keyword'));
    }
}
