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

                <div class="row mb-3">
                    <div class="col-4">
                        <button id="addSupplierModal" class="btn btn-primary">Tambah Barang</button>
                    </div>
                </div>

                <div class="row">
                    <div class="card col-lg-8 px-4 py-4">
                        <table id="tableStokBarang" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th data-ordering="false">No</th>
                                    <th data-ordering="false">Kategori</th>
                                    <th data-ordering="false">Nama Barang</th>
                                    <th data-ordering="false">Jumlah</th>
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


{{-- Show Datatable --}}
@section('table')
@section('modal')
@include('modals.modal')

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
                {data: 'categoryName'},
                {data: 'productName'},
                {data: 'amount'},
                {
                    width: '20%',
                    render:function(data, type, row) {
                            return `
                                <button class='btn btn-info edit' data-id="${row.id}" data-suplliername="${row.supplierName}" data-alamat="${row.alamat}" data-nohp="${row.noHp}">Edit</button>
                                <button class='btn btn-danger delete' data-id='${row.id}'>Delete</button>
                            `
                        }
                }
            ],
        })


        // Add
        $(document).on('click', '#addSupplierModal', function() {
            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Kategori :</label>
                            <input type="text" class="form-control" id="supplierName">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Nama Barang :</label>
                            <input type="text" class="form-control" id="supplierName">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Jumlah :</label>
                            <input type="text" class="form-control" id="supplierName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitAddSupplier">Submit</button>
                </div>
            `)

            $('#modal').modal('show')
        })

    </script>
@endsection
@endsection


@endsection