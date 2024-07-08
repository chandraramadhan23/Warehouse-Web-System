@extends('layouts.main')

@section('container')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="h-100">
                
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Halaman Pengaturan Barang</h2>
                        <p class="text-muted">Welcome to Pengaturan Barang.</p>
                    </div>
                </div>

                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-4">
                            <div class="card px-3 py-3" style="height: 470px">
                                <h4>List Data Kategori {{ $category->categoryName }}</h4>
                                <div class="card mt-3 mb-3">
                                    <button class="btn btn-primary" data-category="{{ $category->categoryName }}" id="addProduct" >Tambah</button>
                                </div>
                                <table id="table-{{ $category->id }}" class="table table-hover nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr class="table-light">
                                            <th data-ordering="false">Nama Barang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody data-category="{{ $category->categoryName }}">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection






@section('modal')
@include('modals.modal')
    
    @section('table')
        <script>

            // Show Datatable
            let tables = {};
            let table = $('table[id^="table-"]').each(function() {
                let tableId = $(this).attr('id');
                let categoryName = $(this).find('tbody').data('category');
                
                $('#' + tableId).DataTable({
                    searching: false,
                    serverSide: false,
                    pageLength: 3,
                    ajax: {
                        type: 'get',
                        url: '/showTableProductsByCategory',
                        data: {
                            categoryName: categoryName,
                        }
                    },
                    columns: [
                        { data: 'productName' },
                        {
                            width: '25%',
                            render: function(data, type, row) {
                                return `
                                    <button class='btn btn-danger delete' data-id='${row.id}'>Delete</button>
                                `;
                            }
                        }
                    ]
                });
            });


            // Add
            $(document).on('click', '#addProduct', function() {
                let category = $(this).data('category')
                let tableId = $(this).data('table-id');

                $('#containerModal').empty().append(`
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Product ${category}</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">Nama Product :</label>
                                <input type="text" class="form-control" id="productName">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submitAddProduct">Submit</button>
                    </div>
                `)

                // Submit
                $(document).off('click', '.submitAddProduct')
                $(document).on('click', '.submitAddProduct', function() {
                    let tableId = $(this).data('table-id');
                    const productName = $('#productName').val()
                    $.ajax({
                        type: 'post',
                        url: '/addProduct',
                        data: {
                            categoryName: category,
                            productName: productName,
                        },
                        success: function() {
                            Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil ditambah',
                            icon: 'success',
                            confirmButtonText: 'Cool',
                            })

                            // tables[tableId].ajax.reload();
                            window.location.reload()
                            $('#modal').modal('hide')
                            $('#productName').val('')
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
                            url: '/deleteProductByCategory/' + id,
                            success: function() {
                                Swal.fire({
                                title: "Deleted!",
                                text: "Supplier has been deleted.",
                                icon: "success"
                                });

                                window.location.reload()
                                
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Error!",
                                    text: "There was an error deleting the supplier.",
                                    icon: "error"
                                });
                            }
                        });
                    } else {
                        
                    }
                })
            })


        </script>
    @endsection

@endsection









