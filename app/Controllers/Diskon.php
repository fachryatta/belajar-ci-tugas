<?php

namespace App\Controllers;

use App\Models\DiskonModel;
use CodeIgniter\Controller;

class Diskon extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    public function index()
    {
        // Cek hanya admin boleh akses
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Unauthorized access.');
        }

        $diskon = $this->diskonModel->findAll();

        return view('v_diskon', ['diskon' => $diskon]);
    }

    public function create()
    {
        return view('diskon/create', [
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'tanggal' => 'required|is_unique[diskon.tanggal]',
            'nominal' => 'required|numeric'
        ];

        if (!$validation->setRules($rules)->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', 'Tanggal sudah terdaftar.');
        }

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal')
        ];

        $this->diskonModel->save($data);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $diskon = $this->diskonModel->find($id);

        if (!$diskon) {
            return redirect()->to('/diskon')->with('error', 'Data diskon tidak ditemukan.');
        }

        return view('diskon/edit', [
            'diskon'     => $diskon,
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'tanggal' => "required|is_unique[diskon.tanggal,id,{$id}]",
            'nominal' => 'required|numeric'
        ];

        if (!$validation->setRules($rules)->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id'      => $id,
            'tanggal' => $this->request->getPost('tanggal'), // tetap kirim tanggal (walau readonly)
            'nominal' => $this->request->getPost('nominal')
        ];

        $this->diskonModel->save($data);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diupdate.');
    }

    public function delete($id)
    {
        $diskon = $this->diskonModel->find($id);

        if (!$diskon) {
            return redirect()->to('/diskon')->with('error', 'Data diskon tidak ditemukan.');
        }

        $this->diskonModel->delete($id);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus.');
    }
}
