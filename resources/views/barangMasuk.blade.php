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
                                            <label for="categoryname">Kategori :</label>
                                            <select class="form-control js-example-basic-single" id="categoryname" name="categoryname">
                                                @foreach($categories as $category)
                                                    <option data-category="{{ $category->categoryName }}" value="{{ $category->categoryName }}">{{ $category->categoryName }}</option>
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
                                                    <option value="{{ $supplier->supplierName }}">{{ $supplier->supplierName }}</option>
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


@section('table')
<script>
    // init select2
    $('.js-example-basic-single').select2();



    // Fungsi Notifikasi Alert
    function notifAlert(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
        });
    }



    // Show DataTable
    let table = $('#tableBarangMasuk').DataTable({
        searching: true,
        serverSide: false,
        data: [],
        columns: [
                {data: 'categoryname'},
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



    // Fungsi untuk memuat data dari Local Storage ke DataTable
    function loadDataToDataTable() {
        let data = JSON.parse(localStorage.getItem('barangMasukData')) || [];
        
        // Bersihkan DataTable
        table.clear().draw();

        // Tambahkan data ke DataTable
        data.forEach(function(item, index) {
            table.row.add({
                categoryname: item.categoryname,
                productname: item.productname,
                supplier: item.supplier,
                amount: item.amount,
                date: item.date,
                id: index // Tambahkan ID atau index untuk tombol Delete jika diperlukan
            }).draw();
        });
    }
    loadDataToDataTable();


    

    // Fungsi Add Product to LocalStorage
    function addProduct() {
        $(document).on('click', '#addButton', function() {
            let categoryname = $('#categoryname').val()
            let productname = $('#productname').val()
            let supplier = $('#supplier').val()
            let amount = $('#amount').val()
            let date = $('#date').val()        
    
            if (!categoryname || !productname || !supplier || !amount || !date) {
                notifAlert('Error!', 'Semua field harus di isi!', 'error')
                return;
            }
    
            let newData = {
                categoryname: categoryname,
                productname: productname,
                supplier: supplier,
                amount: amount,
                date: date
            };
    
            let existingEntries = JSON.parse(localStorage.getItem("barangMasukData")) || [];
            existingEntries.push(newData);
            localStorage.setItem("barangMasukData", JSON.stringify(existingEntries));
    
            notifAlert('Berhasil!', 'Data masuk ke local storage', 'success')
    
            loadDataToDataTable();
    
            // Bersihkan input form
            $('#categoryname, #productname, #supplier, #amount, #date').val('');
        })
    }
    addProduct()




    // Fungsi Show Products by Select Category
    function showProdutByCategory() {
        $(document).ready(function() {
            // Panggil fungsi untuk kategori pertama kali halaman dimuat
            let selectedOption = $('#categoryname').find('option:selected');
            let category = selectedOption.data('category');
            loadProductsByCategory(category);
    
            // Fungsi untuk memuat produk berdasarkan kategori
            function loadProductsByCategory(category) {
                $.ajax({
                    type: 'get',
                    url: 'showOptionCategoryMasuk',
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
                });
            }
    
            // Show Select by Category
            $(document).off('change', '#categoryname')
            $(document).on('change', '#categoryname', function() {
                // Mengambil elemen yang dipilih
                let selectedOption = $(this).find('option:selected');
    
                // Mengambil nilai dari data-category
                let category = selectedOption.data('category');
    
                // Panggil fungsi untuk memuat produk berdasarkan kategori
                loadProductsByCategory(category);
            });
        });
    }
    showProdutByCategory()




    // Fungsi Delete
    function deleteProduct() {
        $(document).off('click', '.delete')
        $(document).on('click', '.delete', function() {
            let index = $(this).data('id')
    
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
                // Lakukan penghapusan dari Local Storage
                let data = JSON.parse(localStorage.getItem('barangMasukData')) || [];
    
                // Hapus item dengan index tertentu dari data
                data.splice(index, 1);
    
                // Simpan kembali data yang sudah di-filter ke dalam Local Storage
                localStorage.setItem('barangMasukData', JSON.stringify(data));
    
                // Tampilkan pesan sukses
                notifAlert('Berhasil!', 'Data berhasil dihapus!', 'success')
    
                // Muat ulang DataTable dari Local Storage
                loadDataToDataTable();
                } else {
                    
                }
            })
        })
    }
    deleteProduct()




    // Funsgi AddEndButton
    function addEndButton() {
        $(document).on('click', '#addButtonEnd', function() {
            let data = JSON.parse(localStorage.getItem('barangMasukData')) || [];
    
            $.ajax({
                type: 'post',
                url: '/endSaveMasuk',
                data: {
                    data: data
                },
                success: function(response) {
                    notifAlert('Berhasil', 'Data berhasil masuk ke stok barang dan laporan', 'success')
    
                    // Kosongkan Local Storage setelah berhasil disimpan ke database (opsional)
                    localStorage.removeItem('barangMasukData');
    
                    // Muat ulang DataTable
                    loadDataToDataTable();
                },
                error: function() {
                    // Tampilkan pesan error
                    notifAlert('Error', 'Data gagal masuk ke stok barang dan laporan', 'error')
                }
            });
        })
    }
    addEndButton()

</script>
@endsection