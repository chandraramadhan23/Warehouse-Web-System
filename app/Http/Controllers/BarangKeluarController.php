<?php

namespace App\Http\Controllers;

use App\Category;
use App\Supplier;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index() {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('barangKeluar', compact('categories', 'suppliers'));
    }
}
