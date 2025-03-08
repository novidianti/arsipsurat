<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Database\Migrations\Jenis;
use App\Models\DisposisiModel; // Mengimpor model UsersModel
use App\Models\UsersModel; // Mengimpor model UsersModel
use App\Models\DokumenModel; // Mengimpor model DocumentModel
use App\Models\JenisModel; // Mengimpor model TypeModel

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('pesan', 'Anda belum login.');
            return redirect()->to('/login');
        }

        // Jika sudah login, tampilkan halaman home
        // return view('admin/home');

        $userModel = new UsersModel(); // Buat instance model Users
        $dokumenModel = new DokumenModel(); // Buat instance model Dokumen
        $jenisModel = new JenisModel(); // Buat instance model Jenis
        $disposisiModel = new DisposisiModel();

        $userCount = $userModel->countAll(); // Menghitung jumlah pengguna
        $dokumenCount = $dokumenModel->countAll(); // Menghitung jumlah dokumen
        $jenisCount = $jenisModel->countAll(); // Menghitung jumlah jenis
        $disposisiCount = $disposisiModel->countAll(); 

        $data = [
            'title' => 'Home',
            'userCount' => $userCount, // Jumlah pengguna
            'dokumenCount' => $dokumenCount, // Jumlah dokumen
            'jenisCount' => $jenisCount, // Jumlah jenis
            'disposisiCount' => $disposisiCount
    ];

        return view('admin/home', $data); // Kirimkan data ke view
    }
}
