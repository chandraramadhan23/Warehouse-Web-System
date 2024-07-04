<?php

namespace App\Http\Controllers;

use App\InProductReport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanBarangMasukController extends Controller
{
    public function index() {
        return view('laporans.laporanBarangMasuk');
    }



    public function showTable() {
        $reports = InProductReport::all();

        return DataTables::of($reports)->make(true);
    }
}
