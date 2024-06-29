@extends('layouts.main')

@section('container')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="h-100">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Halaman Barang Keluar</h2>
                                <p class="text-muted">Welcome to Barang Keluar Page.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card px-4 py-4">
                                    <form>
                                        <h3>Form Input</h3>
                                        <div class="mb-3 mt-4">
                                            <label for="category">Kategori :</label>
                                            <select class="form-control" id="category">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->nameCategory }}">{{ $category->nameCategory }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product">Nama Barang :</label>
                                            <select class="form-control" id="product">
                                                <option value="">Jaket Hoodie (masih manual)</option>
                                                <option value="">Jaket Crunek (masih manual)</option>
                                                <option value="">Jaket Jeans (masih manual)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="supplier">Supplier :</label>
                                            <select class="form-control" id="supplier">
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->nameSupplier }}">{{ $supplier->nameSupplier }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="date">Tanggal :</label>
                                            <input type="date" class="form-control" id="date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount">Jumlah :</label>
                                            <input type="text" class="form-control" id="amount">
                                        </div>
                                        <button type="button" class="btn btn-info" id="addButton">Tambah</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card px-4 py-4">
                                    <table id="tableBarangKeluar" class="table table-hover nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr class="table-light">                                                
                                                <th data-ordering="false">Kategori</th>
                                                <th data-ordering="false">Nama Barang</th>
                                                <th data-ordering="false">Supplier</th>
                                                <th data-ordering="false">Tanggal</th>
                                                <th data-ordering="false">Jumlah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card">
                                    <button class="btn btn-primary">Selesai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




{{-- Show Datatable --}}
@section('table')
    <script>
        let table = $('#tableBarangKeluar').DataTable({
            //
        })
    </script>
@endsection




<script>

// Add Barang Keluar
$(document).on('click', '#addButton', function() {
    //        
})

</script>
        
@endsection