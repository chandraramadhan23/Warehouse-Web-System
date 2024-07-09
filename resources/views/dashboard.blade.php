<style>
    #totalproduk, #totallaporan {
        max-width: 100%;
        height: auto !important;
        width: auto !important;
    }

    .kategori {
        background-color: rgba(75, 192, 192, 0.2) !important;
    }
    .supplier {
        background-color: rgba(255, 205, 86, 0.2) !important;
    }
</style>

@extends('layouts.main')

@section('container')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="h-100">
                
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Halaman Dashboard</h2>
                        <p class="text-muted">Welcome to Dashboard Page.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Total Stok : {{ $totalProduct }} Barang</h4>
                                        <canvas id="totalproduk"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card px-3 py-3">
                                    <div class="card-body">
                                        <canvas id="totallaporan"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card px-3 py-3 kategori">
                                    <h5 class="mb-3">Total Kategori : {{ $totalKategori }}</h5>
                                    @foreach($categoryAmounts as $categoryName => $totalAmount)
                                        <h6>{{ $categoryName }} : {{ $totalAmount }}</h6>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card px-3 py-3 supplier">
                                    <h5>Total Supplier : {{ $totalSupplier }}</h5>
                                    @foreach($suppliers as $supplier)
                                        <h6>{{ $supplier->supplierName }} ({{ $supplier->noHp }})</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('chart')

<script>

    // Chart Total Produk
    const ctxTotalProduk = document.getElementById('totalproduk');
    const dataTotalProduk = {
        labels: [
            @foreach($amounts as $productName => $totalAmount)
                "{{ $productName }}",
            @endforeach
        ],
        datasets: [{
            label: 'Total Produk',
            data: [
                @foreach($amounts as $productName => $totalAmount)
                    {{ $totalAmount }},
                @endforeach
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)',
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
            ],
            borderWidth: 1,
            hoverOffset: 4
        }]
    };

    new Chart(ctxTotalProduk, {
        type: 'bar',
        data: dataTotalProduk,
    });




    // Chart Total Laporan
    const ctxTotalLaporan = document.getElementById('totallaporan');
    const dataTotalLaporan  = {
        labels: [
            'Laporan Masuk', 'Laporan Keluar',
        ],
        datasets: [{
            label: 'Total Laporan',
            data: [
                {{ $totalLaporanMasuk }}, {{ $totalLaporanKeluar }}
            ],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)',
            ],
            borderColor: [
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)',
            ],
            borderWidth: 1,
            hoverOffset: 4,
        }]
    };

    new Chart(ctxTotalLaporan, {
        type: 'doughnut',
        data: dataTotalLaporan,
    });

</script>

@endsection