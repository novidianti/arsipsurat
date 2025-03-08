<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DisposisiModel;

class Disposisi extends BaseController
{
    public function index()
    {
        $disposisiModel = new DisposisiModel();
        $data = [
            'title' => 'Data Disposisi',
            'jabatan' => $disposisiModel->findAll()
        ];
        return view('admin/disposisi/disposisi', $data);
    }

    public function create(){
        $data = [
            'title' => 'Tambah Jabatan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/disposisi/create', $data);
    }

    public function store(){
        $rules = [
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jabatan wajib diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Jabatan',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/disposisi/create', $data);
        }else{
            $disposisiModel = new DisposisiModel();
            $disposisiModel->insert([
                'jabatan' => $this->request->getPost('jabatan')
            ]);

            session()->setFlashdata('berhasil', 'Data Jabatan Berhasil Ditambah');

            return redirect()->to(base_url('admin/disposisi'));
        }
    }

    public function edit($id){
        $disposisiModel = new DisposisiModel();
        $data = [
            'title' => 'Edit Disposisi',
            'disposisi' => $disposisiModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/disposisi/edit', $data);
    }

    public function update($id){
        $disposisiModel = new DisposisiModel();
        $rules = [
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jabatan wajib diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Jabatan',
                'jabatan' => $disposisiModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/disposisi/edit', $data);
        }else{
            $disposisiModel = new DisposisiModel();
            $disposisiModel->update($id, [
                'jabatan' => $this->request->getPost('jabatan')
            ]);

            session()->setFlashdata('berhasil', 'Jabatan Berhasil Diupdate');

            return redirect()->to(base_url('admin/disposisi'));
        }
    }

    function delete($id){
        $disposisiModel = new DisposisiModel();

        $jabatan = $disposisiModel->find($id);
        if($jabatan){
            $disposisiModel->delete($id);
            session()->setFlashdata('berhasil', 'Jabatan Berhasil Dihapus');

            return redirect()->to(base_url('admin/disposisi'));
        }
    }
}

