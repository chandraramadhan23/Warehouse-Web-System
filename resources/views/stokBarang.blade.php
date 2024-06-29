@extends('layouts.main')

@section('container')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="h-100">
                
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Halaman Stok Barang</h2>
                        <p class="text-muted">Welcome to Stok Barang Page.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="card col-lg-8 px-4 py-4">
                        <table id="tableStokBarang" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th data-ordering="false">No</th>
                                    <th data-ordering="false">Nama Barang</th>
                                    <th data-ordering="false">Kategori</th>
                                    <th data-ordering="false">Jumlah</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


{{-- Show Datatable --}}
@section('table')
    <script>

        let table = $('#tableStokBarang').DataTable({
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableStokBarang',
                dataSrc: function(json) {
                    for(let i = 0, len = json.data.length; i < len; i++) {
                        json.data[i].no = i + 1;
                    }
                    return json.data;
                },
            },
            columns: [
                {data: 'no'},
                {data: 'name'},
                {data: 'nameCategory'},
                {data: 'amount'},
            ],
        })

    </script>
@endsection


@endsection