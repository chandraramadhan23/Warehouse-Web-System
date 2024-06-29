{{-- View --}}
@extends('layouts.main')

@section('container')
    <div class="row">
        {{-- Input --}}
        <div class="col-6">
            <form>
                <h3>Form Input</h3>
                @csrf
                <div>
                    <label>Nama Barang :</label>
                    <inpu class="form-control" id="namaBarang">
                </div>
                <div>
                    <label>Jumlah :</label>
                    <inpu class="form-control" id="jumlah">
                </div>
                <button class="btn" id="addButton">Tambah</button>
            </form>
        </div>
        {{-- Output --}}
        <div class="col-6">
            <table id="tableBarangMasuk" class="table" style="width:100%">
                <thead>
                    <tr class="table-light">                                                
                        <th data-ordering="false">Nama Barang</th>
                        <th data-ordering="false">Jumlah</th>
                    </tr>
                </thead>
            </table>
            <div class="card">
                <button class="btn btn-primary" id="addButtonEnd">Selesai</button>
            </div>
        </div>
    </div>
@endsection

{{-- Show Datatable --}}
@section('table')
    <script>
        let table = $('#tableBarangMasuk').DataTable({
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableBarangMasuk',
            },
            columns: [
                    {data: 'namaBarang'},
                    {data: 'jumlah'},
                    {
                        data: 'id',
                        render:function(data, type, row) {
                            return `
                                <button class='btn btn-danger delete' data-id="' + data + '">Delete</button>
                            `
                        }
                    }
            ]
        })
    </script>
@endsection

<script>
    // Add
    $(document).on('click', '#addButton', function() {
        let namaBarang = $('#namaBarang').val()
        let jumlah = $('#jumlah').val()

        $.ajax({
            type: 'post',
            url: '/addSession',
            data: {
                _token: '{{ csrf_token() }}',
                namaBarang: namaBarang,
                jumlah: jumlah,
            },
            success: function() {
                alert('Berhasil!');
                table.ajax.reload();
            }
        })
    })

    // Delete
    $(document).on('click', '.delete', function() {
        let id = $(this).data('id')

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
    })


</script>

{{-- Route --}}
Route::get('/barangMasuk', 'BarangMasukController@index');
Route::get('/showTableBarangMasuk', 'BarangMasukController@showTable');
Route::post('/addSession', 'BarangMasukController@addSession');
Route::post('/deleteSession/{id}', 'BarangMasukController@delete');


{{-- Controller --}}
public function index() {
    return view('barangMasuk');
}

public function showTable() {
    $items = session()->get('items', []);
    return DataTables::of($items)
        ->addColumn('namaBarang', function($item) {
            return $item['namaBarang'];
        })
        ->addColumn('jumlah', function($item) {
            return $item['jumlah'];
        })
}

public function addSession(Request $request) {
    $items = session()->get('items', []);
    $newItem = [
        'namaBarang' => $request->input('namaBarang'),
        'jumlah' => $request->input('jumlah'),
    ];
    $items[] = $newItem;
    session()->put('items', $items);

    return response()->json(['success' => 'Item added successfully']);
}


public function delete($id) {
    $items = session()->get('items', []);
    if(isset($items[$id])) {
        unset($items[$id]);
        session()->put('items', array_values($items));
    }
    return response()->json(['success' => 'Item deleted successfully']);
}
