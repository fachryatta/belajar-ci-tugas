<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\DiskonModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];
    protected $diskonHariIni = null;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Ambil data diskon hari ini
        $diskonModel = new DiskonModel();
        $today = date('Y-m-d');
        $this->diskonHariIni = $diskonModel->where('tanggal', $today)->first();

        // Simpan ke session jika diskon tersedia
        if ($this->diskonHariIni) {
            session()->set('diskon_hari_ini', $this->diskonHariIni['nominal']);
        } else {
            session()->remove('diskon_hari_ini');
        }

        // Share variabel ke semua view
        service('renderer')->setVar('diskonHariIni', $this->diskonHariIni);
    }
}
