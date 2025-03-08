<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JenisModel;
use App\Models\DisposisiModel;
use App\Models\DokumenModel;

class Dokumen extends BaseController
{
    protected $dokumenModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
    }

    public function index()
    {
    $data = [
        'title' => 'Data Dokumen',
        'dokumen' => $this->dokumenModel->orderBy('id', 'DESC')->findAll(),
    ];
    return view('admin/dokumen/dokumen', $data);
    }

    public function detail($id)
    {
    $dokumenModel = new DokumenModel();
    $db = \Config\Database::connect();

    $data = [
        'title' => 'Detail Surat',
        'dokumen' => $dokumenModel->detailDokumen($id), // Perbaiki menggunakan $dokumenModel
    ];

    return view('admin/dokumen/detail', $data);
    }


    public function create()
    {
    $dokumenModel = new DokumenModel();
    $db = \Config\Database::connect();

    // Query builder untuk tabel disposisi
    $disposisiBuilder = $db->table('disposisi');
    $disposisi = $disposisiBuilder->get()->getResultArray();

    // Query builder untuk tabel jenis
    $jenisBuilder = $db->table('jenis');
    $jenis = $jenisBuilder->get()->getResultArray();

    $data = [
        'title' => 'Tambah Surat',
        'disposisi' => $disposisi, // Kirimkan hasil query disposisi
        'jenis' => $jenis, // Kirimkan hasil query jenis
        'validation' => \Config\Services::validation() // Validasi untuk form
    ];

    return view('admin/dokumen/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_dokumen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama dokumen wajib diisi"
                ],
            ],
            'no_kop' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nomor kop wajib diisi"
                ],
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,2048]|ext_in[file,pdf,doc,docx]',
                'errors' => [
                    'uploaded' => "File dokumen wajib diunggah",
                    'max_size' => "Ukuran file terlalu besar",
                    'ext_in' => "Ekstensi file tidak valid"
                ],
            ],
            'disposisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Disposisi wajib diisi"
                ],
            ],
            'keluar_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kategori surat (keluar/masuk) wajib diisi"
                ],
            ],
            'belum_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Status surat wajib diisi"
                ],
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jenis surat wajib diisi"
                ],
            ],
            'tanggal_dokumen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tanggal dokumen wajib diisi"
                ],
            ],
            'tentang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tentang wajib diisi"
                ],
            ],
            'halaman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jumlah halaman wajib diisi"
                ],
            ],
        ];
    
        // Validasi input
        if (!$this->validate($rules)) {
            $dokumenModel = new DokumenModel();
            $db = \Config\Database::connect();
    
            // Query builder untuk tabel disposisi
            $disposisiBuilder = $db->table('disposisi');
            $disposisi = $disposisiBuilder->get()->getResultArray();
    
            // Query builder untuk tabel jenis
            $jenisBuilder = $db->table('jenis');
            $jenis = $jenisBuilder->get()->getResultArray();
    
            $data = [
                'title' => 'Tambah Surat',
                'disposisi' => $disposisi, // Kirimkan hasil query disposisi
                'jenis' => $jenis, // Kirimkan hasil query jenis
                'validation' => \Config\Services::validation() // Validasi untuk form
            ];
    
            return view('admin/dokumen/create', $data);
        } else {
            // Ambil input
            $disposisiId = $this->request->getPost('disposisi');
            $jenisId = $this->request->getPost('jenis');
            $nama_dokumen = $this->request->getPost('nama_dokumen');
            $no_kop = $this->request->getPost('no_kop');
            $tanggal_dokumen = $this->request->getPost('tanggal_dokumen');
            $tentang = $this->request->getPost('tentang');
            $halaman = $this->request->getPost('halaman');
            $keluar_masuk = $this->request->getPost('keluar_masuk');
            $belum_selesai = $this->request->getPost('belum_selesai');
    
            // Proses upload file
            $file = $this->request->getFile('file');
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move('uploads', $fileName);
            } else {
                $fileName = null;
            }
    
            // Simpan ke database
            $dokumenModel = new DokumenModel();
            $dokumenModel->insert([
                'nama_dokumen' => $nama_dokumen,
                'no_kop' => $no_kop,
                'file' => $fileName,
                'disposisi' => $disposisiId,
                'keluar_masuk' => $keluar_masuk,
                'belum_selesai' => $belum_selesai,
                'jenis' => $jenisId,
                'tanggal_dokumen' => $tanggal_dokumen,
                'tentang' => $tentang,
                'halaman' => $halaman
            ]);
    
            session()->setFlashdata('berhasil', 'Dokumen berhasil ditambahkan');
            return redirect()->to(base_url('admin/dokumen'));
        }
    }
    

    public function edit($id)
{
    $dokumenModel = new DokumenModel();
    $db = \Config\Database::connect();

    // Ambil data disposisi dan jenis
    $disposisiBuilder = $db->table('disposisi');
    $disposisi = $disposisiBuilder->get()->getResultArray();

    $jenisBuilder = $db->table('jenis');
    $jenis = $jenisBuilder->get()->getResultArray();

    $data = [
        'title' => 'Edit Dokumen',
        'dokumen' => $dokumenModel->find($id),
        'disposisi' => $disposisi,
        'jenis' => $jenis,
        'validation' => \Config\Services::validation()
    ];

    return view('admin/dokumen/edit', $data);
}

public function update($id)
{
    $dokumenModel = new DokumenModel();
    
    $rules = [
        'nama_dokumen' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Nama dokumen wajib diisi"
            ],
        ],
        'no_kop' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Nomor kop wajib diisi"
            ],
        ],
        'disposisi' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Disposisi wajib diisi"
            ],
        ],
        'keluar_masuk' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Kategori surat (keluar/masuk) wajib diisi"
            ],
        ],
        'belum_selesai' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Status surat wajib diisi"
            ],
        ],
        'jenis' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Jenis surat wajib diisi"
            ],
        ],
        'tanggal_dokumen' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Tanggal dokumen wajib diisi"
            ],
        ],
        'tentang' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Tentang wajib diisi"
            ],
        ],
        'halaman' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Jumlah halaman wajib diisi"
            ],
        ],
    ];

    if (!$this->validate($rules)) {
        $db = \Config\Database::connect();
        
        // Ambil data disposisi dan jenis jika validasi gagal
        $disposisiBuilder = $db->table('disposisi');
        $disposisi = $disposisiBuilder->get()->getResultArray();

        $jenisBuilder = $db->table('jenis');
        $jenis = $jenisBuilder->get()->getResultArray();

        $data = [
            'title' => 'Edit Dokumen',
            'dokumen' => $dokumenModel->find($id),
            'disposisi' => $disposisi,
            'jenis' => $jenis,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/dokumen/edit', $data);
    } else {
        // Ambil data dokumen yang ada
        $currentDokumen = $dokumenModel->find($id);
        
        // Proses update
        $disposisiId = $this->request->getPost('disposisi');
        $jenisId = $this->request->getPost('jenis');

        // Proses upload file
        $file = $this->request->getFile('file');
        $fileName = null;

        if ($file->isValid() && !$file->hasMoved()) {
            // Jika ada file baru, hapus file lama
            if ($currentDokumen && $currentDokumen['file']) {
                $filePath = 'uploads/' . $currentDokumen['file'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file lama
                }
            }

            // Simpan file baru
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
        } else {
            // Jika tidak ada file baru, gunakan nama file yang lama
            $fileName = $currentDokumen['file'];
        }

        // Update dokumen
        $dokumenModel->update($id, [
            'nama_dokumen' => $this->request->getPost('nama_dokumen'),
            'no_kop' => $this->request->getPost('no_kop'),
            'disposisi' => $disposisiId,
            'keluar_masuk' => $this->request->getPost('keluar_masuk'),
            'belum_selesai' => $this->request->getPost('belum_selesai'),
            'jenis' => $jenisId,
            'tanggal_dokumen' => $this->request->getPost('tanggal_dokumen'),
            'tentang' => $this->request->getPost('tentang'),
            'halaman' => $this->request->getPost('halaman'),
            'file' => $fileName // Simpan nama file baru
        ]);

        session()->setFlashdata('berhasil', 'Dokumen berhasil diperbarui');
        return redirect()->to(base_url('admin/dokumen'));
    }
    
}


    function delete($id){
        $dokumenModel = new DokumenModel();

        $nama_dokumen = $dokumenModel->find($id);
        if($nama_dokumen){
            $dokumenModel->delete($id);
            session()->setFlashdata('berhasil', 'Dokumen Berhasil Dihapus');

            return redirect()->to(base_url('admin/dokumen'));
        }
    }
}