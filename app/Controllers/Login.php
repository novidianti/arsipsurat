<?php

namespace App\Controllers;
use App\Models\LoginModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('Login', $data);
    }

    public function login_action()
{
    // Aturan validasi input
    $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    if (!$this->validate($rules)) {
        $data['validation'] = $this->validator;
        return view('Login', $data);
    } else {
        $session = session();
        $loginModel = new LoginModel();

        // Ambil username dan password dari form login
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Dapatkan data user berdasarkan username
        $cekusername = $loginModel->where('username', $username)->first();
        echo "Username yang dimasukkan: " . $username . "<br>";
        echo "Password yang dimasukkan: " . $password . "<br>";

        if ($cekusername) {
            $password_db = $cekusername['password'];
            echo "Password di database: " . $password_db . "<br>";

            // Cek apakah password di database masih dalam bentuk plain text
            if (password_needs_rehash($password_db, PASSWORD_DEFAULT)) {
                // Jika masih plain text, lakukan hash dan update password di database
                $hashed_password = password_hash($password_db, PASSWORD_DEFAULT);
                $loginModel->update($cekusername['id'], ['password' => $hashed_password]);
                $password_db = $hashed_password; // Update nilai password_db dengan hash baru
                echo "Password baru di-hash: " . $password_db . "<br>";
            }

            // Verifikasi password yang dimasukkan user dengan password yang ada di database
            $cek_password = password_verify($password, $password_db);
            if ($cek_password) {
                // Jika password benar, buat session untuk user
                $session_data = [
                    'username'  => $cekusername['username'],
                    'logged_in' => TRUE,
                    'status'    => $cekusername['status']
                ];
                $session->set($session_data);

                // Redirect sesuai dengan status user
                switch ($cekusername['status']) {
                    case "Admin":
                        return redirect()->to('admin/home');
                    case "Kepala":
                        return redirect()->to('kepala/home');
                    default:
                        $session->setFlashdata('pesan', 'Akun Anda Belum Terdaftar');
                        return redirect()->to('/');
                }
            } else {
                // Jika password salah
                $session->setFlashdata('pesan', 'Password Salah, Silahkan coba lagi');
                return redirect()->to('/');
            }
        } else {
            // Jika username tidak ditemukan
            $session->setFlashdata('pesan', 'Username Salah, Silahkan coba lagi');
            return redirect()->to('/');
        }
    }
}


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
