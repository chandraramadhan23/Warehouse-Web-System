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
                        <button class="btn btn-success" id="print">
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

        // Notifikasi Alert
        function notifAlert(title, text, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
            });
        }



        // Show DataTable
        function showTable() {
            $('#tableLaporanBarangMasuk').DataTable({
                bDestroy: true,
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
                ],
            })
        }
        showTable()



        // Delete
        function deleteReport() {
            $(document).off('click', '.delete')
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
                            url: '/deleteLaporanMasuk/' + id,
                            success: function() {
                                notifAlert('Berhasil', 'Data berhasil dihapus!', 'success')
                                showTable()
                            },
                            error: function() {
                                notifAlert('Error', 'Data gagal dihapus!', 'error')
                            }
                        });
                    } else {
                        showTable()
                    }
                })
            })
        }
        deleteReport()



        // Print Laporan
        function printReport() {
            $(document).on('click', '#print', function() {
                window.print();
            })
        }
        printReport()

    </script>
@endsection