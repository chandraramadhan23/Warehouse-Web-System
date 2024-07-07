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
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableLaporanBarangMasuk',
                dataSrc: function(json) {
                    for(let i = 0, len = json.data.length; i < len; i++) {
                        json.data[i].no = i + 1;
                    }
                    return json.data;
                },
            },
            columns: [
                    {data: 'no'},
                    {data: 'categoryName'},
                    {data: 'productName'},
                    {data: 'supplierName'},
                    {data: 'amount'},
                    {data: 'date'},
                    {
                        render:function(data, type, row) {
                            return `
                                <button class='btn btn-danger delete' data-id='${row.id}'>Delete</button>
                            `
                        }
                    }
            ]
        })
    </script>
@endsection