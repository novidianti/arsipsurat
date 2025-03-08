<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JenisModel;

class Jenis extends BaseController
{
    public function index()
    {
        $jenisModel = new JenisModel();
        $data = [
            'title' => 'Data Jenis',
            'jenis' => $jenisModel->findAll()
        ];
        return view('admin/jenis/jenis', $data);
    }

    public function create(){
        $data = [
            'title' => 'Tambah Jenis',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/jenis/create', $data);
    }

    public function store(){
        $rules = [
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama jenis surat wajib diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Jenis',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/jenis/create', $data);
        }else{
            $jenisModel = new JenisModel();
            $jenisModel->insert([
                'jenis' => $this->request->getPost('jenis')
            ]);

            session()->setFlashdata('berhasil', 'Data Jenis Surat Berhasil Ditambah');

            return redirect()->to(base_url('admin/jenis'));
        }
    }

    public function edit($id){
        $jenisModel = new JenisModel();
        $data = [
            'title' => 'Edit Jenis',
            'jenis' => $jenisModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/jenis/edit', $data);
    }

    public function update($id){
        $jenisModel = new JenisModel();
        $rules = [
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama jenis surat wajib diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Jenis',
                'jenis' => $jenisModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/jenis/edit', $data);
        }else{
            $jenisModel = new JenisModel();
            $jenisModel->update($id, [
                'jenis' => $this->request->getPost('jenis')
            ]);

            session()->setFlashdata('berhasil', 'Data Jenis Surat Berhasil Diupdate');

            return redirect()->to(base_url('admin/jenis'));
        }
    }

    function delete($id){
        $jenisModel = new JenisModel();

        $jenis = $jenisModel->find($id);
        if($jenis){
            $jenisModel->delete($id);
            session()->setFlashdata('berhasil', 'Data Jenis Surat Berhasil Dihapus');

            return redirect()->to(base_url('admin/jenis'));
        }
    }
}
