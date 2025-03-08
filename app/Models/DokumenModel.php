<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table            = 'dokumen';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_dokumen',
        'no_kop',
        'file',
        'disposisi',
        'keluar_masuk',
        'belum_selesai',
        'jenis',
        'tanggal_dokumen',
        'tentang',
        'halaman'
    ];

    public function countBelumSelesai()
    {
        return $this->where('belum_selesai', 1)->countAllResults(); // Menghitung dokumen yang belum selesai
    }

    public function get_dokumen()
    {
        return $this->select('dokumen.*, disposisi.jabatan, jenis.jenis') // Ganti nama_disposisi dengan jabatan jika itu nama yang benar
                    ->join('disposisi', 'disposisi.id = dokumen.disposisi', 'left')
                    ->join('jenis', 'jenis.id = dokumen.jenis', 'left')
                    ->findAll(); 
    }

    public function detailDokumen($id)
    {
        return $this->where('dokumen.id', $id) // Spesifik kolom 'id' dari tabel 'dokumen'
                    ->join('disposisi', 'disposisi.id = dokumen.disposisi', 'left')
                    ->join('jenis', 'jenis.id = dokumen.jenis', 'left')
                    ->first();  // Menggunakan first() untuk mendapatkan satu baris data
    }
    

}