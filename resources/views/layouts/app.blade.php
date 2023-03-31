<!DOCTYPE html>
<html
lang="en"
class="light-style layout-menu-fixed layout-navbar-fixed"
dir="ltr"
data-theme="theme-default"
data-assets-path="{{ url('/') }}/assets/"
data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/> --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="{{ env('APP_NAME') }}">
	<meta name="author" content="{{ env('APP_NAME') }} Author">
	<meta name="keyword" content="{{ env('APP_NAME') }}">

    <meta name="mobile-web-app-capable" content="yes">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fff">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fff">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <link rel="manifest" href="{{ url('/') }}/manifest.json">

    <title>{{ env('APP_NAME') }} - @yield('title') </title>
    
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/assets/img/favicon/favicon.ico" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
    />
    
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/boxicons.css" />
    
    <!-- Core CSS -->
    @if (session('themes') == 'dark')
        <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/core-dark.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/theme-default-dark.css" class="template-customizer-theme-css" />
    @else
        <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    @endif
    
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/demo.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    
    {{-- SELECT2 --}}
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/select2/select2.min.css" />
    <!-- Page CSS -->
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

    <!-- Helpers -->
    <script src="{{ url('/') }}/assets/vendor/js/helpers.js"></script>
    
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ url('/') }}/assets/js/config.js"></script>

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
                                {{ env('APP_NAME') }}
                                {{-- <img src="https://i.ibb.co/HN6Sdhk/logo-suratku-2.png" style="width: 180px" alt="Logo Suratku"> --}}
                            </span>
                        </a>
                
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>
            
                    <div class="menu-inner-shadow"></div>

            
                    <ul class="menu-inner py-1">
                        <li class="menu-item @if($menu_aktif=="dashboard") active @endif">
                            <a href="{{ URL::to('/dashboard') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                <div>Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item @if($menu_aktif=="admin.user") active @endif">
                            <a href="{{ URL::to('/dashboard') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div>User</div>
                            </a>
                        </li>
                        
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
                                                        <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                        <small class="text-muted">{{ Auth::user()->level }}</small>
                                                    </div>
                                                </div>
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

                        <div class="container-fluid flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-md-12 col-12 mb-md-0 mb-4">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
      
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

        @yield('modal')

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('/') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ url('/') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ url('/') }}/assets/js/main.js"></script>
    <script src="{{ url('/') }}/assets/vendor/select2/select2.full.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @if (!empty($editor_aktif))
        <script src="{{ url('/') }}/assets/vendor/tinymce/tinymce.min.js"></script>
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

    /*     
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
    }); */
    </script>



    @yield('js')
    
    <!-- 
    {{ var_dump(json_encode(session()->all())) }}
    -->
    </body>
</html>
