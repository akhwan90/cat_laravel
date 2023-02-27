
<!DOCTYPE html>

<!-- =========================================================
    * Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
    ==============================================================
    
    * Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
    * Created by: ThemeSelection
    * License: You must have a valid license purchased in order to legally use the theme for your project.
    * Copyright ThemeSelection (https://themeselection.com)
    
    =========================================================
-->
<!-- beautify ignore:start -->
<html
lang="en"
class="light-style layout-menu-fixed layout-navbar-fixed"
dir="ltr"
data-theme="theme-default"
data-assets-path="{{ URL::to('/assets') }}/assets/"
data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/> --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="Aplikasi Suratku">
	<meta name="author" content="Dinas  Kominfo Kab. Kulon Progo">
	<meta name="keyword" content="Aplikasi Tata Persuratan Kabupaten Kulon Progo">

    <meta name="mobile-web-app-capable" content="yes">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fff">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fff">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <link rel="manifest" href="{{ url('/') }}/manifest.json">

    <title>SuratKu Pemkab Kulon Progo - @yield('title') </title>
    
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ URL::to('/assets') }}/assets/img/favicon/favicon.ico" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
    />
    
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/fonts/boxicons.css" />
    
    <!-- Core CSS -->
    @if (session('themes') == 'dark')
        <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/css/core-dark.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/css/theme-default-dark.css" class="template-customizer-theme-css" />
    @else
        <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    @endif
    
    <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/css/demo.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    
    {{-- SELECT2 --}}
    <link rel="stylesheet" href="{{ URL::to('/assets') }}/assets/vendor/select2/select2.min.css" />
    <!-- Page CSS -->
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

    <!-- Helpers -->
    <script src="{{ URL::to('/assets') }}/assets/vendor/js/helpers.js"></script>
    
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ URL::to('/assets') }}/assets/js/config.js"></script>

        <style type="text/css">
            .select2 {
                width: 100% !important;
            }
            .select2-selection__rendered {
                line-height: 31px !important;
                padding: 2px;
            }
            .select2-container .select2-selection--single {
                height: 35px !important;
            }
            .select2-selection__arrow {
                height: 34px !important;
            }
            #listPenerimaSurat > tr {
                cursor: grab;
            }
        </style>
    </head>
    
    <body>

        <!-- Toast with Placements -->
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div id="toastPlacement" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9000"></div>
        </div>
        <!-- Toast with Placements -->

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="{{ URL::to('/') }}" class="app-brand-link">
                            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                                <!-- suratku
                                <sup style="color: #b12b2b">2023</sup>-->
                                <img src="https://i.ibb.co/HN6Sdhk/logo-suratku-2.png" style="width: 180px" alt="Logo Suratku">
                            </span>
                        </a>
                
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>
            
                    <div class="menu-inner-shadow"></div>

            
                    <ul class="menu-inner py-1">
                        <!-- Dashboard -->
                        <li class="menu-item @if($menu_aktif=="dashboard") active @endif">
                            <a href="{{ URL::to('/') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                <div>Dashboard</div>
                            </a>
                        </li>
                        
                        @if (in_array(1, session('roles')))

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-danger">Menu Admin System</span>
                        </li>

                        <li class="menu-item @if($menu_aktif=="admin_instansi") active @endif">
                            <a href="{{ URL::to('/admin/instansi') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-building"></i>
                                <div>Instansi</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_struktur") active @endif">
                            <a href="{{ URL::to('/admin/struktur_organisasi') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                                <div>Struktur Organisasi</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_user") active @endif">
                            <a href="{{ URL::to('/admin/users') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div>User</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_user_role") active @endif">
                            <a href="{{ URL::to('/admin/usersRoles') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div>User Role Detil</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_kop") active @endif">
                            <a href="{{ URL::to('/admin/kop') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-qr"></i>
                                <div>Kop Surat</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_ruang_rapat") active @endif">
                            <a href="{{ URL::to('/admin/ruangRapat') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-news"></i>
                                <div>Ruang Rapat</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_penelusuran_surat") active @endif">
                            <a href="{{ URL::to('/admin/penelusuranSurat') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-envelope"></i>
                                <div>Penelusuran Surat</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_log_aktivitas") active @endif">
                            <a href="{{ URL::to('/admin/logAktivitas') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-pen"></i>
                                <div>Log Aktivitas</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_log_tte") active @endif">
                            <a href="{{ URL::to('/admin/logTte') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-pen"></i>
                                <div>Log TTE</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_blog") active @endif">
                            <a href="{{ URL::to('/admin/blog') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-rss"></i>
                                <div>Blog</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_template") active @endif">
                            <a href="{{ URL::to('/admin/template') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-file"></i>
                                <div>Template Surat</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_tools") active open @endif">
                            <a href="#" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-wrench"></i>
                                <div>Tools</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ URL::to('/admin/tools') }}" class="menu-link">
                                        <div>Pindah Bawahan Banyak</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ URL::to('/admin/tools/bawahanSimasneg') }}" class="menu-link">
                                        <div>Tambahkan Bawahan dari Simasneg</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ URL::to('/admin/tools/listAdmin') }}" class="menu-link">
                                        <div>Admin - Struktur - Instansi</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ URL::to('/admin/tools/sinkronisasiSimasneg') }}" class="menu-link">
                                        <div>Perbandingan Data dengan Simasneg</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    
                        @elseif (in_array(2, session('roles')))
                        
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-warning">Menu Admin Surat OPD</span>
                        </li>


                        <li class="menu-item @if($menu_aktif=="admin_opd_surat_masuk") active @endif" >
                            <a href="{{ URL::to('/adminOpd/suratMasuk') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-archive-in"></i>
                                <div>Surat Masuk</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_admin_surat_masuk"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_opd_surat_keluar") active @endif">
                            <a href="{{ URL::to('/adminOpd/suratKeluar') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-archive-out"></i>
                                <div>Surat Keluar</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_admin_surat_keluar"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_opd_kirim_surat") active @endif">
                            <a href="{{ URL::to('/adminOpd/kirimSurat') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-send"></i>
                                <div>Kirim Surat</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_admin_kirim_surat"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_opd_struktur_organisasi") active @endif">
                            <a href="{{ URL::to('/adminOpd/strukturOrganisasi') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                                <div>Struktur Organisasi</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_opd_users") active @endif">
                            <a href="{{ URL::to('/adminOpd/users') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div>Daftar User</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_opd_instansi_luar") active @endif">
                            <a href="{{ URL::to('/adminOpd/instansiLuar') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-building"></i>
                                <div>Daftar Instansi Luar</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_opd_grup_kontak") active @endif">
                            <a href="{{ URL::to('/adminOpd/grupKontak') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
                                <div>Grup Kontak</div>
                            </a>
                        </li>

                        @endif

                        @if (in_array(3, session('roles')))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-info">Menu Admin Ruang Rapat</span>
                        </li>

                        <li class="menu-item @if($menu_aktif=="admin_ruang_rapat_persetujuan") active @endif" >
                            <a href="{{ URL::to('/adminRapat/persetujuan') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-check"></i>
                                <div>Persetujuan</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin_ruang_rapat_list_ruang_rapat") active @endif" >
                            <a href="{{ URL::to('/adminRapat/listRuang') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-building"></i>
                                <div>Ruang Rapat</div>
                            </a>
                        </li>
                        @endif

                        @if (in_array(4, session('roles')))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-danger">Admin Ruang Rapat Virtual</span>
                        </li>

                        <li class="menu-item @if($menu_aktif=="admin_ruang_rapat_virtual_persetujuan") active @endif" >
                            <a href="{{ URL::to('/adminRapatVirtual/persetujuan') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-check"></i>
                                <div>Persetujuan</div>
                            </a>
                        </li>
                        @endif

                        {{-- ADMIN ARSIP PEMKAB --}}
                        @if (in_array(5, session('roles')))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-danger">Admin Pemkab</span>
                        </li>

                        <li class="menu-item @if($menu_aktif=="admin_pemkab_surat_masuk") active @endif" >
                            <a href="{{ URL::to('/adminPemkab/suratMasuk') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-archive-in"></i>
                                <div>Surat Masuk</div>
                            </a>
                        </li>
                        @endif

                        {{-- ADMIN ARSIP PUSAT --}}
                        @if (in_array(6, session('roles')))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-info">Menu Admin Arsip Pusat</span>
                        </li>

                        <li class="menu-item @if($menu_aktif=="admin_arsip_pusat_jra") active @endif" >
                            <a href="{{ URL::to('/adminArsipPusat/jra') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                                <div>Klasifikasi JRA</div>
                            </a>
                        </li>
                        @endif
                        
                        @if (!in_array(1, session('roles')))
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text text-success">Menu Pribadi</span>
                        </li>

                        <li class="menu-item @if($menu_aktif=="user_surat_masuk") active @endif">
                            <a href="{{ URL::to('/user/surat_masuk') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-archive-in"></i>
                                <div>Surat Masuk</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_user_surat_masuk"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_surat_keluar") active @endif">
                            <a href="{{ URL::to('/user/surat_keluar') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-archive-out"></i>
                                <div>Surat Keluar</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_disposisi_masuk") active @endif">
                            <a href="{{ URL::to('/user/disposisi_masuk') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-down-arrow-circle"></i>
                                <div>Disposisi Masuk</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_user_disposisi_masuk"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_disposisi_keluar") active @endif">
                            <a href="{{ URL::to('/user/disposisi_keluar') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-right-arrow-circle"></i>
                                <div>Disposisi Keluar</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_disposisi_retro") active @endif">
                            <a href="{{ URL::to('/user/disposisi_retro') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-minus-circle"></i>
                                <div>Disposisi Retro</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_user_disposisi_retro"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_verifikasi") active @endif">
                            <a href="{{ URL::to('/user/verifikasi') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-check"></i>
                                <div>Verifikasi</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_verifikasi"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_verifikasi_gagal") active @endif">
                            <a href="{{ URL::to('/user/verifikasi/gagal') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-minus-circle"></i>
                                <div>Konsep Ditolak</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_konsep_ditolak"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_tandatangan") active @endif">
                            <a href="{{ URL::to('/user/tandatangan') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-pen"></i>
                                <div>Tandatangan</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_tandatangan"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_agendapribadi") active @endif">
                            <a href="{{ URL::to('/user/agendapribadi') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-calendar"></i>
                                <div>Agenda Pribadi</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_agendapribadi"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_ruangrapat") active @endif">
                            <a href="{{ URL::to('/user/ruangRapat') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-card"></i>
                                <div>Ruang Rapat </div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_ruangrapat"></span>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="user_ruangrapat_virtual") active @endif">
                            <a href="{{ URL::to('/user/ruangRapatVirtual') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-card"></i>
                                <div>Ruang Rapat Virtual</div>
                                <span class="badge bg-danger ms-auto d-none" id="notif_ruangrapat"></span>
                            </a>
                        </li>

                        @endif
                    </ul>
                </aside>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->
    <nav
        class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar"
        >
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                @if (session('themes') == 'dark')
                    <li class="nav-item me-2 me-xl-0">
                        <a class="nav-link style-switcher-toggle hide-arrow" href="{{ url('themesChange?to=light')}}" >
                        <i class="bx bx-sm bx-sun"></i>
                        </a>
                    </li>                    
                @else
                    <li class="nav-item me-2 me-xl-0">
                        <a class="nav-link style-switcher-toggle hide-arrow" href="{{ url('themesChange?to=dark')}}" >
                        <i class="bx bx-sm bx-moon"></i>
                        </a>
                    </li>
                @endif
                
                <!-- User -->
                <li class="nav-item me-2 me-xl-0">
                    <a class="nav-link style-switcher-toggle hide-arrow" href="#" onclick="return false;">
                    {{ session('nama') }}
                    </a>
                </li>
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ url('getProfilePict') }}" alt class="rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ url('/profile') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ url('getProfilePict') }}" alt class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ session('nama') }}</span>
                                        <small class="text-muted">{{ session('username') }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ URL::to('gantiTahun') }}">
                                <i class="bx bx-calendar me-2"></i>
                                <span class="align-middle">Ganti Tahun</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ URL::to('petunjuk') }}">
                                <i class="bx bx-question-mark me-2"></i>
                                <span class="align-middle">Petunjuk</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ URL::to('logout') }}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>
    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">

        @yield('content')

        @yield('modal')
        
        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    Template by : 
                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->


    </div>
    <!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ URL::to('/assets') }}/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ URL::to('/assets') }}/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ URL::to('/assets') }}/assets/vendor/js/bootstrap.js"></script>
<script src="{{ URL::to('/assets') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{ URL::to('/assets') }}/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ URL::to('/assets') }}/assets/js/main.js"></script>
<script src="{{ URL::to('/assets') }}/assets/vendor/select2/select2.full.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@if (!empty($editor_aktif))
    <script src="{{ URL::to('/assets') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script language="JavaScript">
        // window.onbeforeunload = confirmExit;
        // function confirmExit() {
        //     return "Please click Update. Unsaved changes will be lost.";
        // }
    </script>
@endif


<script type="text/javascript">
const base_url = "{{ URL::to(''); }}/";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function notif(tipe, title, body) {
    let bg_type = "";
    let icon = "bx-bell";

    if (tipe == "success") {
        bg_type = "bg-success";
        icon = "bx-check-circle";
    } else if (tipe == "warning") {
        bg_type = "bg-warning";
        icon = "bx-info-circle";
    } else if (tipe == "danger") {
        bg_type = "bg-danger";
        icon = "bx-error-circle";
    }

    let htm = 
        '<div class="bs-toast toast m-3 top-0 end-0 '+bg_type+'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">'+
            '<div class="toast-header">'+
                '<i class="bx '+icon+' me-2"></i>'+
                '<div class="me-auto fw-semibold">'+title+'</div>'+
                // '<small>11 mins ago</small>'+
                '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>'+
            '</div>'+
            '<div class="toast-body">'+
            body+
            '</div>'+
        '</div>';
    $("#toastPlacement").prepend(htm);

    // $(".toast-placement-ex").toast('show');
    const t = document.querySelector(".bs-toast");
    new bootstrap.Toast(t).show();
}

$.ajax({
    type: "GET",
    url: base_url + 'user/notif',
    success: function(res) {
        if (res.notif_verifikasi > 0) {
            $("#notif_verifikasi").addClass('d-block');
            $("#notif_verifikasi").removeClass('d-none');
            $("#notif_verifikasi").html(res.notif_verifikasi);
        }
        if (res.notif_tandatangan > 0) {
            $("#notif_tandatangan").addClass('d-block');
            $("#notif_tandatangan").removeClass('d-none');
            $("#notif_tandatangan").html(res.notif_tandatangan);
        }
        if (res.notif_konsep_ditolak > 0) {
            $("#notif_konsep_ditolak").addClass('d-block');
            $("#notif_konsep_ditolak").removeClass('d-none');
            $("#notif_konsep_ditolak").html(res.notif_konsep_ditolak);
        }
        if (res.notif_admin_surat_keluar > 0) {
            $("#notif_admin_surat_keluar").addClass('d-block');
            $("#notif_admin_surat_keluar").removeClass('d-none');
            $("#notif_admin_surat_keluar").html(res.notif_admin_surat_keluar);
        }
        if (res.notif_admin_surat_masuk > 0) {
            $("#notif_admin_surat_masuk").addClass('d-block');
            $("#notif_admin_surat_masuk").removeClass('d-none');
            $("#notif_admin_surat_masuk").html(res.notif_admin_surat_masuk);
        }
        if (res.notif_admin_kirim_surat > 0) {
            $("#notif_admin_kirim_surat").addClass('d-block');
            $("#notif_admin_kirim_surat").removeClass('d-none');
            $("#notif_admin_kirim_surat").html(res.notif_admin_kirim_surat);
        }
        if (res.notif_user_surat_masuk > 0) {
            $("#notif_user_surat_masuk").addClass('d-block');
            $("#notif_user_surat_masuk").removeClass('d-none');
            $("#notif_user_surat_masuk").html(res.notif_user_surat_masuk);
        }
        if (res.notif_user_disposisi_masuk > 0) {
            $("#notif_user_disposisi_masuk").addClass('d-block');
            $("#notif_user_disposisi_masuk").removeClass('d-none');
            $("#notif_user_disposisi_masuk").html(res.notif_user_disposisi_masuk);
        }
        if (res.notif_user_disposisi_retro > 0) {
            $("#notif_user_disposisi_retro").addClass('d-block');
            $("#notif_user_disposisi_retro").removeClass('d-none');
            $("#notif_user_disposisi_retro").html(res.notif_user_disposisi_retro);
        }
        if (res.notif_agendapribadi > 0) {
            $("#notif_agendapribadi").addClass('d-block');
            $("#notif_agendapribadi").removeClass('d-none');
            $("#notif_agendapribadi").html(res.notif_agendapribadi);
        }
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});
</script>



@yield('js')
@yield('jsForm')

<!-- 
{{ var_dump(json_encode(session()->all())) }}
-->

</body>
</html>
