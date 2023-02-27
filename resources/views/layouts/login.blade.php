
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
class="light-style customizer-hide"
dir="ltr"
data-theme="theme-default"
data-assets-path="{{ URL::to('assets') }}/assets/"
data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    
    <meta name="mobile-web-app-capable" content="yes">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#4285f4">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#4285f4">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#4285f4">
        
    <title>SuratKu Lite - Login </title>
    
    <meta name="description" content="" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ URL::to('assets') }}/assets/img/favicon/favicon.ico" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
    />
    
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ URL::to('assets') }}/assets/vendor/fonts/boxicons.css" />
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ URL::to('assets') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ URL::to('assets') }}/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ URL::to('assets') }}/assets/vendor/js/helpers.js"></script>
    
    </head>
    
    <body>
        <div class="authentication-wrapper authentication-cover">
            <div class="authentication-inner row m-0">
                <!-- /Left Text -->
                <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="https://i.ibb.co/BqJDNrw/suatku-1.png" class="img-fluid" alt="Login image" width="700" data-app-dark-img="https://i.ibb.co/BqJDNrw/suatku-1.png" data-app-light-img="https://i.ibb.co/BqJDNrw/suatku-1.png">
                </div>
                </div>
                <!-- /Left Text -->

                <!-- Login -->
                <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-4 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-3">
                        <a href="{{ url('login') }}" class="app-brand-link gap-1">
                            <img src="https://i.ibb.co/HN6Sdhk/logo-suratku-2.png" style="width: 200px">
                        </a>
                    </div>
                    <!-- /Logo -->
                    {{-- <h4 class="mb-2">Welcome to SuratKu! 👋</h4> --}}
                    <p class="mb-4">Silakan login dengan menggunakan Username dan Password Anda.</p>

                    <form id="formAuthentication" class="mb-3" action="{{ URL::to('/do_login') }}" method="POST">
                        @csrf
                        {!! session('error') !!}
                        <div class="mb-3">
                            <label for="email" class="form-label">Username</label>
                            <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="username"
                            placeholder="Enter your username"
                            autofocus
                            />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <a href="#">
                                <small>Lupa Password?</small>
                            </a>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
                        </div>
                    </form>

                    
                    <div class="mt-3">
                        <a href="{{ url('scan_qr') }}" class="btn btn-outline-info w-100"><i class="bx bx-qr"></i> Scan QR Surat</a>
                        <a href="{{ url('statistik') }}" class="btn btn-outline-warning w-100 mt-1"><i class="bx bx-bar-chart-alt-2"></i> Statistik Suratku</a>
                        <a href="{{ url('petunjuk') }}" class="btn btn-outline-success w-100 mt-1"><i class="bx bx-question-mark"></i> Petunjuk Suratku</a>
                    </div>


                    <div class="px-3">
                        <div class="col-lg-12 text-center">
                            <img src="https://bssn.go.id/wp-content/uploads/2017/09/logo-bsre.png" style="width: 200px">
                        </div>
                        <div class="col-lg-12 text-center">
                            <small class="text-dark">suratKU Pemerintah Kabupaten Kulon Progo mendukung tanda tangan elektronik dari
                                Balai Sertifikasi Elektronik (BsrE) Badan Siber dan Sandi Negara (BSSN)</small>
                        </div>
                    </div>

                </div>
                </div>
                <!-- /Login -->
            </div>
            </div>

            <!-- / Content -->

            <script src="{{ URL::to('assets') }}/assets/js/main.js"></script>
</body>
</html>
