<?php

namespace App\Http\Controllers;

use App\OutProductReport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanBarangKeluarController extends Controller
{
    public function index() {
        return view('laporans.laporanBarangKeluar');
    }



    public function showTable() {
        $reports = OutProductReport::all();

        return DataTables::of($reports)->make(true);
    }



    public function delete($id) {
        OutProductReport::find($id)->delete();
    }
}
