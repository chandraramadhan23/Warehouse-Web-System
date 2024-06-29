@extends('layouts.main')

@section('container')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="h-100">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Halaman Barang Masuk</h2>
                                <p class="text-muted">Welcome to Barang Masuk Page.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card px-4 py-4">
                                    <form id="productForm">
                                        <h3>Form Input</h3>
                                        @csrf
                                        <div class="mb-3">
                                            <label for="category">Kategori :</label>
                                            <select class="form-control js-example-basic-single" id="category" name="category">
                                                @foreach($categories as $category)
                                                    <option data-category="{{ $category->nameCategory }}" value="{{ $category->nameCategory }}">{{ $category->nameCategory }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productname">Nama Barang :</label>
                                            <select class="form-control js-example-basic-single" id="productname" name="productname">
                                                <option value="">Pilih Barang</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="supplier">Supplier :</label>
                                            <select class="form-control js-example-basic-single" id="supplier" name="supplier">
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->nameSupplier }}">{{ $supplier->nameSupplier }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount">Jumlah :</label>
                                            <input type="text" class="form-control" id="amount" name="amount">
                                        </div>
                                        <div class="mb-3">
                                            <label for="date">Tanggal :</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                        <button type="button" class="btn btn-info" id="addButton">Tambah</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card px-4 py-4">
                                    <table id="tableBarangMasuk" class="table table-hover nowrap align-middle" style="width:100%">
                                        <thead>
                                            <tr class="table-light">                                                
                                                <th data-ordering="false">Kategori</th>
                                                <th data-ordering="false">Nama Barang</th>
                                                <th data-ordering="false">Supplier</th>
                                                <th data-ordering="false">Jumlah</th>
                                                <th data-ordering="false">Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card">
                                    <button class="btn btn-primary" id="addButtonEnd">Selesai</button>
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
    let tableBarangMasuk = $('#tableBarangMasuk').DataTable({
        searching: true,
        serverSide: true,
        ajax: {
            type: 'get',
            url: '/showTableBarangMasuk',
        },
        columns: [
                {data: 'category'},
                {data: 'productname'},
                {data: 'supplier'},
                {data: 'amount'},
                {data: 'date'},
                {
                    data: 'id',
                    render:function(data, type, row) {
                        return `
                            <button class='btn btn-danger delete' data-id="${data}">Delete</button>
                        `
                    }
                }
        ]
    })
</script>


<script>

    $('.js-example-basic-single').select2();

    // Add Product Session
    $(document).on('click', '#addButton', function() {
        let category = $('#category').val()
        let productname = $('#productname').val()
        let supplier = $('#supplier').val()
        let amount = $('#amount').val()
        let date = $('#date').val()        

        $.ajax({
            type: 'post',
            url: '/addSession',
            data: {
                _token: '{{ csrf_token() }}',
                category: category,
                productname: productname,
                supplier: supplier,
                amount: amount,
                date: date,
            },
            success: function() {
                Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil ditambah',
                icon: 'success',
                confirmButtonText: 'Cool',
                })

                tableBarangMasuk.ajax.reload()
                $('#category').val('')
                $('#productname').val('')
                $('#supplier').val('')
                $('#amount').val('')
                $('#date').val('')
            }
        })
    })

    // Show Select by Category
    $(document).on('change', '#category', function() {
        // Mengambil elemen yang dipilih
        let selectedOption = $(this).find('option:selected');

        // Mengambil nilai dari data-category
        let category = selectedOption.data('category');

        $.ajax({
            type: 'get',
            url: 'showOptionCategory',
            data: {
                categoryName: category,
            },
            success: function(response) {
                // Kosongkan elemen select produk
                $('#productname').empty();

                $.each(response, function(index, item) {
                    $('#productname').append(`
                        <option value="${item.productName}">${item.productName}</option>
                    `);
                });
            }
        })
        

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
            }).then((result) =>{
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '/deleteSession/' + id,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire({
                            title: "Deleted!",
                            text: "Data has been deleted.",
                            icon: "success"
                            });

                            tableBarangMasuk.ajax.reload();
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
                    tableBarangMasuk.ajax.reload()
                }
            })
    })

</script>
@endsection