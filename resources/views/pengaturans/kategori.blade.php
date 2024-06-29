@extends('layouts.main')

@section('container')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="h-100">

                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Daftar Kategori</h2>
                                <p class="text-muted">Welcome to Category Page.</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <button id="addCategoryModal" class="btn btn-primary">Tambah Kategori</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">List Kategori</h5>
                                    </div>

                                    <div class="card-body">
                                        <table id="tableCategory" class="table align-middle" style="width:100%">
                                            <thead>
                                                <tr class="table-light">
                                                    <th data-ordering="false">No</th>
                                                    <th data-ordering="false">Nama Kategori</th>
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
        </div>
        
@endsection




{{-- Show Datatable --}}
@section('table')

    <script>

        let table = $('#tableCategory').DataTable({
            searching: false,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableKategori',
            },
            columns: [
                {data: 'id'},
                {data: 'categoryName'},
                {
                    width: '30%',
                    render:function(data, type, row) {
                        return `
                            <button class='btn btn-danger delete' data-id='${row.id}'>Delete</button>
                        `
                    }
                }
            ],
        })

    </script>

@endsection




@section('modal')
    @include('modals.modal')
    <script>
        // Add Category
        $(document).on('click', '#addCategoryModal', function() {
            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Nama Category :</label>
                            <input type="text" class="form-control" id="categoryName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitAddCategory">Submit</button>
                </div>
            `)

            $('#modal').modal('show')
        })

        $(document).on('click', '#submitAddCategory', function() {
            const categoryName = $('#categoryName').val()

            $.ajax({
                type: 'post',
                url: '/addCategory',
                data: {
                    categoryName: categoryName,
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
                    $('#categoryName').val('')
                }
            })
        })



        // Delete Category
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
                        url: '/deleteCategory/' + id,
                        success: function() {
                            Swal.fire({
                            title: "Deleted!",
                            text: "Category has been deleted.",
                            icon: "success"
                            });

                            table.ajax.reload();
                        },
                        error: function() {
                            Swal.fire({
                                title: "Error!",
                                text: "There was an error deleting the Category.",
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