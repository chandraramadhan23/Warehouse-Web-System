@extends('layouts.main')

@section('container')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="h-100">
                
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Halaman Laporan Barang Masuk</h2>
                        <p class="text-muted">Welcome to Laporan Barang Masuk Page.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-4 d-flex justify-content-end">
                        <button class="btn btn-success">
                            <i class="ri-printer-line me-2"></i>Print Laporan
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card px-4 py-4">
                            <table id="tableLaporanBarangMasuk" class="table table-hover nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-light">                     
                                        <th data-ordering="false">No</th>
                                        <th data-ordering="false">Kategori</th>
                                        <th data-ordering="false">Nama Barang</th>
                                        <th data-ordering="false">Supplier</th>
                                        <th data-ordering="false">Jumlah</th>
                                        <th data-ordering="false">Tanggal</th>
                                        <th data-ordering="false">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection


@section('table')
    <script>
        let table = $('#tableLaporanBarangMasuk').DataTable({
            //
        })
    </script>
@endsection