<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class PembelianController extends BaseController
{
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
    }

    public function index()
    {
        // Hanya admin yang bisa mengakses
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('/'))->with('error', 'Unauthorized');
        }

        $data['pembelian'] = $this->transaction->findAll();

        return view('v_pembelian', $data);
    }

    public function ubahStatus($id)
    {
        $transaksi = $this->transaction->find($id);
        if ($transaksi) {
            $newStatus = $transaksi['status'] == 1 ? 0 : 1;
            $this->transaction->update($id, ['status' => $newStatus]);
        }

        return redirect()->to(base_url('pembelian'))->with('success', 'Status berhasil diubah.');
    }
}
