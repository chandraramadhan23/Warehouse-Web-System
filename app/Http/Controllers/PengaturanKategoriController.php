<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengaturanKategoriController extends Controller
{
    public function index() {
        return view('pengaturans.kategori');
    }


    // Show Table
    public function showTable() {
        $categorys = Category::all();

        return DataTables::of($categorys)->make(true);
    }



    // Add Category
    public function add(Request $request) {
        Category::create([
            'categoryName' => $request->categoryName,
        ]);
    }



    // Delete Category
    public function delete($id) {
        Category::find($id)->delete();
    }
}
