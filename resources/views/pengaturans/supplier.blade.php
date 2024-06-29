@extends('layouts.main')

@section('container')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="h-100">
                
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Halaman Pengaturan Supplier</h2>
                        <p class="text-muted">Welcome to Pengaturan Supplier.</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4">
                        <button id="addSupplierModal" class="btn btn-primary">Tambah Supplier</button>
                    </div>
                </div>

                <div class="row">
                    <div class="card col-lg-12 px-4 py-4">
                        <table id="tableSupplier" class="table table-hover nowrap align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th data-ordering="false">No</th>
                                    <th data-ordering="false">Nama Supplier</th>
                                    <th data-ordering="false">Alamat</th>
                                    <th data-ordering="false">No Hp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection




{{-- Show Datatable Suppliers --}}
@section('table')
    <script>
        let table = $('#tableSupplier').DataTable({
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableSupplier',
                dataSrc: function(json) {
                    for(let i = 0, len = json.data.length; i < len; i++) {
                        json.data[i].no = i + 1;
                    }
                    return json.data;
                },
            },
            columns: [
                    {data: 'no'},
                    {data: 'nameSupplier'},
                    {data: 'alamat'},
                    {data: 'noHp'},
                    {
                        render:function(data, type, row) {
                            return `
                                <button class='btn btn-info edit' data-id="${row.id}" data-namesupplier="${row.nameSupplier}" data-alamat="${row.alamat}" data-nohp="${row.noHp}">Edit</button>
                                <button class='btn btn-danger delete' data-id='${row.id}'>Delete</button>
                            `
                        }
                    }
            ]
        })
    </script>
@endsection





@section('modal')
    @include('modals.modal')

    <script>
        // Add
        $(document).on('click', '#addSupplierModal', function() {
            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Add New Supplier</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Nama Supplier :</label>
                            <input type="text" class="form-control" id="nameSupplier">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Alamat :</label>
                            <textarea class="form-control" id="alamat" style="height: 100px"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">No HP :</label>
                            <input type="text" class="form-control" id="noHp">
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
        // Add Submit
        $(document).on('click', '#submitAddSupplier', function() {
            const nameSupplier = $('#nameSupplier').val()
            const alamat = $('#alamat').val()
            const noHp = $('#noHp').val()

            $.ajax({
                type: 'post',
                url: '/addSupplier',
                data: {
                    nameSupplier: nameSupplier,
                    alamat: alamat,
                    noHp: noHp,
                },
                success: function() {
                    Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil ditambah',
                    icon: 'success',
                    confirmButtonText: 'Cool',
                    })

                    table.ajax.reload()
                    $('#modal').modal('hide')
                    $('#nameSupplier').val('')
                    $('#alamat').val('')
                    $('#noHp').val('')
                }
            })
        })





        // Edit 
        $(document).on('click', '.edit', function() {
            let id = $(this).data('id')
            let nameSupplier = $(this).data('namesupplier')
            let alamat = $(this).data('alamat')
            let noHp = $(this).data('nohp')

            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Nama Supplier :</label>
                            <input type="text" class="form-control" id="nameSupplierUpdate" value="${nameSupplier}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Alamat :</label>
                            <textarea class="form-control" id="alamatUpdate" value="${alamat}" style="height: 100px"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">No HP :</label>
                            <input type="text" class="form-control" id="noHpUpdate" value="${noHp}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditSupplier">Submit</button>
                </div>
            `)

            $(document).on('click', '#submitEditSupplier', function() {
                const nameSupplier = $('#nameSupplierUpdate').val()
                const alamat = $('#alamatUpdate').val()
                const noHp = $('#noHpUpdate').val()

                $.ajax({
                    type: 'put',
                    url: '/editSupplier',
                    data: {
                        id: id,
                        nameSupplier: nameSupplier,
                        alamat: alamat,
                        noHp: noHp,
                    },

                    success: function() {
                        Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di edit',
                        icon: 'success',
                        confirmButtonText: 'Cool',
                        })

                        table.ajax.reload()
                        $('#modal').modal('hide')
                    }
                })
            })

            $('#modal').modal('show')
        })




        // Delete 
        $(document).on('click', '.delete', function() {
            let id = $(this).data('id')

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to delete this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '/deleteSupplier/' + id,
                        success: function() {
                            Swal.fire({
                            title: "Deleted!",
                            text: "Customer has been deleted.",
                            icon: "success"
                            });

                            table.ajax.reload();
                        },
                        error: function() {
                            Swal.fire({
                                title: "Error!",
                                text: "There was an error deleting the customer.",
                                icon: "error"
                            });
                        }
                    });
                } else {
                    table.ajax.reload()
                }
            })
        })
    </script>
@endsection