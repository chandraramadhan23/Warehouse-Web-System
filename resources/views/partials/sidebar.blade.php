<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-widgets">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('stokBarang*') ? 'active' : '' }}" href="/stokBarang">
                        <i class=" ri-bank-line"></i> <span data-key="t-widgets">Stok Barang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('barangMasuk*') ? 'active' : '' }}" href="/barangMasuk">
                        <i class="ri-add-line"></i> <span data-key="t-widgets">Barang Masuk</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('barangKeluar*') ? 'active' : '' }}" href="/barangKeluar">
                        <i class="ri-subtract-line"></i> <span data-key="t-widgets">Barang Keluar</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('laporanBarangKeluar') || Request::is('laporanBarangMasuk')) ? 'active' : '' }}" href="#sidebarLaporan" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLaporan">
                        <i class="mdi mdi-sticker-text-outline"></i> <span data-key="t-laporan">Laporan Barang</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLaporan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/laporanBarangMasuk" class="nav-link" data-key="t-analytics"> Barang Masuk </a>
                            </li>
                            <li class="nav-item">
                                <a href="/laporanBarangKeluar" class="nav-link" data-key="t-crm"> Barang Keluar </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('barang') || Request::is('kategori') || Request::is('supplier')) ? 'active' : '' }}" href="#sidebarPengaturan" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPengaturan">
                        <i class="ri-settings-2-line"></i> <span data-key="t-pengaturan">Pengaturan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPengaturan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/barang" class="nav-link" data-key="t-analytics"> Barang </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kategori" class="nav-link" data-key="t-analytics"> Kategori </a>
                            </li>
                            <li class="nav-item">
                                <a href="/supplier" class="nav-link" data-key="t-crm"> Supplier </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

{{-- Vertical Overlay --}}
<div class="vertical-overlay"></div>