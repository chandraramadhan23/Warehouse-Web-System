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
                        <div class="col-lg-12">
                            <button id="deleteSelected" style="display: none;" class="btn btn-danger mb-3"><i
                                    class="ri-delete-bin-line"></i> Delete Item</button>
                        </div>
                        <table id="tableStokBarang" class="table table-striped table-hover nowrap align-middle"
                            style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th data-ordering="false"><input type="checkbox" id="selectAll"></th>
                                    <th data-ordering="false">No</th>
                                    <th data-ordering="false">Kategori</th>
                                    <th data-ordering="false">Nama Barang</th>
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



@section('table')
<script>
    // Show DataTable
    function showTable() {
        $('#tableStokBarang').DataTable({
            bDestroy: true,
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableStokBarang',
                dataSrc: function (json) {
                    for (let i = 0, len = json.data.length; i < len; i++) {
                        json.data[i].no = i + 1;
                    }
                    return json.data;
                },
            },
            columns: [{
                    data: null,
                    width: '5%',
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="selectRow" value="' + row.id + '">';
                    },
                    orderable: false
                },
                {
                    data: 'no',
                    width: '10%'
                },
                {
                    data: 'categoryName'
                },
                {
                    data: 'productName'
                },
                {
                    data: 'amount'
                },
            ],
        })
    }
    showTable()


    // Toggle delete button visibility
    function toggleDeleteButton() {
        let anyChecked = $('.selectRow:checked').length > 0;
        $('#deleteSelected').toggle(anyChecked);
    }


    // Handle row click to toggle checkbox
    $('#tableStokBarang tbody').on('click', 'tr', function (event) {
        if (event.target.type !== 'checkbox') {
            let checkbox = $(this).find('.selectRow');
            checkbox.prop('checked', !checkbox.prop('checked'));
            toggleDeleteButton();
        }
    });

    // Prevent checkbox click from toggling twice
    $('#tableStokBarang tbody').on('click', '.selectRow', function (event) {
        event.stopPropagation();
        toggleDeleteButton();
    });


    // Handle Select All checkbox
    $('#selectAll').on('click', function () {
        $('.selectRow').prop('checked', this.checked);
        toggleDeleteButton();
    });



    // Handle Delete Selected button
    $('#deleteSelected').on('click', function () {
        let selectedItems = [];
        $('.selectRow:checked').each(function () {
            let row = $(this).closest('tr');
            let categoryName = row.find('td').eq(2).text();
            let productName = row.find('td').eq(3).text();
            let amount = row.find('td').eq(4).text();
            selectedItems.push({
                id: $(this).val(),
                categoryName: categoryName,
                productName: productName,
                amount: amount
            });
        });

        if (selectedItems.length > 0) {
            let itemList = '';
            selectedItems.forEach(function (item) {
                itemList += `<h5>${item.productName}(${item.categoryName}) = ${item.amount}</h5>`;
            });

            Swal.fire({
                title: "Are you sure?",
                html: itemList,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let selectedIds = selectedItems.map(item => item.id);

                    $.ajax({
                        url: '/deleteByStokBarang',
                        type: 'post',
                        data: {
                            ids: selectedIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function () {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Item Stok Barang has been deleted.",
                                icon: "success"
                            });

                            showTable()
                        },
                        error: function () {
                            Swal.fire({
                                title: "Error!",
                                text: "There was an error deleting the stok barang.",
                                icon: "error"
                            });
                        }
                    });
                }
            })
        }
    });
</script>
@endsection


@endsection