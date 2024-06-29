<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StokBarangController extends Controller
{
    public function index() {
        return view('stokBarang');
    }

    public function showTable() {
        $products = Product::all();

        return DataTables::of($products)->make(true);
    }
}
