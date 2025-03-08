<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\DisposisiModel;

class Users extends BaseController
{
    public function index()
    {   
    $usersModel = new UsersModel();
    $data = [
        'title' => 'Data Pengguna',
        'users' => $usersModel->detailUsers() // Memanggil method yang telah diperbaiki
    ];
    return view('admin/users/users', $data);
    }

    public function create() {
        $usersModel = new UsersModel();
        $db = \Config\Database::connect();
        $builder = $db->table('disposisi');
    
        $data = [
            'title' => 'Tambah Pengguna',
            'users' => $usersModel->detailUsers(),
            'disposisi' => $builder->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/users/create', $data);
    }
    
    public function store() {
        $rules = [
            'disposisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Disposisi wajib diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password wajib diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi'
                ]
            ],
        ];
    
        // Validasi input
        if (!$this->validate($rules)) {
            $usersModel = new UsersModel();
            $db = \Config\Database::connect();
            $builder = $db->table('disposisi');
    
            $data = [
                'title' => 'Tambah Users',
                'users' => $usersModel->detailUsers(),
                'disposisi' => $builder->get()->getResultArray(),
                'validation' => \Config\Services::validation()
            ];
    
            return view('admin/users/create', $data);
        } else {
            // Tangani nilai 'null' dari input disposisi
            $disposisiId = $this->request->getPost('disposisi');
            if ($disposisiId == 'null') {
                $disposisiId = null; // Set null jika pengguna memilih "Tidak ada jabatan"
            }
    
            // Jika disposisi diisi dan valid
            if ($disposisiId !== null) {
                $disposisiId = null; 
                $disposisiModel = new DisposisiModel();
                $disposisiExists = $disposisiModel->find($disposisiId);
        
                if (!$disposisiExists) {
                    session()->setFlashdata('error', 'ID Disposisi tidak valid.');
                    return redirect()->back()->withInput();
                }
            }
    
            // Lakukan hashing password sebelum insert ke tabel users
            $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

            // Lakukan insert ke tabel users
            $usersModel = new UsersModel();
            $usersModel->insert([
                'disposisi' => $disposisiId,  // Bisa null atau id valid
                'username' => $this->request->getPost('username'),
                'password' => $hashedPassword,  // Simpan password yang sudah di-hash
                'status' => $this->request->getPost('status'),
            ]);
    
            // Tampilkan pesan sukses jika insert berhasil
            session()->setFlashdata('berhasil', 'Data Users Berhasil Ditambah');
            return redirect()->to(base_url('admin/users'));
        }
    }
    
    public function edit($id) {
        $usersModel = new UsersModel();
        $db = \Config\Database::connect();
        $builder = $db->table('disposisi');
    
        $data = [
            'title' => 'Ubah Pengguna',
            'users' => $usersModel->find($id), // Ambil detail user berdasarkan ID
            'disposisi' => $builder->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/users/edit', $data);
    }
    
    public function update($id) {
        $usersModel = new UsersModel();
        $rules = [
            'disposisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Disposisi wajib diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password wajib diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi'
                ]
            ],
        ];
    
        if (!$this->validate($rules)) {
            $db = \Config\Database::connect();
            $builder = $db->table('disposisi');
            $data = [
                'title' => 'Edit Users',
                'users' => $usersModel->find($id),
                'disposisi' => $builder->get()->getResultArray(),
                'validation' => \Config\Services::validation()
            ];
            return view('admin/users/edit', $data);
        } else {
            $disposisiId = $this->request->getPost('disposisi');
            if ($disposisiId == 'null') {
                $disposisiId = null; // Set null jika pengguna memilih "Tidak ada jabatan"
            }
    
            // Cek jika disposisiId valid
            if ($disposisiId !== null) {
                $disposisiModel = new DisposisiModel();
                $disposisiExists = $disposisiModel->find($disposisiId);
    
                if (!$disposisiExists) {
                    session()->setFlashdata('error', 'ID Disposisi tidak valid.');
                    return redirect()->back()->withInput();
                }
            }
    
            // Lakukan hashing password sebelum update ke tabel users
            $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
    
            $usersModel->update($id, [
                'disposisi' => $disposisiId,
                'username' => $this->request->getPost('username'),
                'password' => $hashedPassword, // Simpan password yang sudah di-hash
                'status' => $this->request->getPost('status'),
            ]);
    
            session()->setFlashdata('berhasil', 'Users Berhasil Diupdate');
            return redirect()->to(base_url('admin/users'));
        }
    }
    

    function delete($id){
        $usersModel = new UsersModel();

        $users = $usersModel->find($id);
        if($users){
            $usersModel->delete($id);
            session()->setFlashdata('berhasil', 'Users Berhasil Dihapus');

            return redirect()->to(base_url('admin/users'));
        }
    }
}




