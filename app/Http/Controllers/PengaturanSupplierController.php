<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengaturanSupplierController extends Controller
{
    public function index() {
        return view('pengaturans.supplier');
    }


    // Show Table
    public function showTable() {
        $suppliers = Supplier::all();

        return DataTables::of($suppliers)->make(true);
    }


    // Add Supplier
    public function add(Request $request) {
        Supplier::create([
            'supplierName' => $request->supplierName,
            'alamat' => $request->alamat,
            'noHp' => $request->noHp,
        ]);
    }


    // Edit Supplier
    public function update(Request $request) {
        Supplier::where('id', $request->id)->update([

            'supplierName' => $request->supplierName,
            'alamat' => $request->alamat,
            'noHp' => $request->noHp,

        ]);
    }


    // Delete Supplier
    public function delete($id) {
        Supplier::find($id)->delete();
    }
}
