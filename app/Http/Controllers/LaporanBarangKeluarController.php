<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanBarangKeluarController extends Controller
{
    public function index() {
        return view('laporans.laporanBarangKeluar');
    }
}
