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
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fff">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fff">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">

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
    
    </head>
    
    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->                
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            
                    <div class="menu-inner-shadow"></div>
                    
					<div id="countdown" class="py-3 bg-white text-center h2 mb-0 mt-1"></div>
                    
                    <hr class="mt-0"/>
                    <h4 class="text-center">Navigator Soal</h4>
                    <hr class="mt-0"/>

                    <div id="navigatorSoal">
                                                
                    </div>
                </aside>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <div class="container-fluid flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-md-12 col-12 mb-md-0 mb-4">
                                    <div class="card">
                                        <h5 class="card-header" id="headerSoal"></h5>
                                        <div class="card-body">
                                            <div id="contentSoal"></div>
                                            <div id="opsiSoal"></div>

                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="btn btn-outline-primary mr-2" id="tombolPrev" onclick="return prev();">Sebelum</a> 
                                                <a href="#" class="btn btn-outline-primary" id="tombolNext" onclick="return next();">Selanjutnya</a>
                                                <a href="#" class="btn btn-outline-danger" id="tombolSelesai" onclick="return selesai(true);">Selesai</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
        </div>
        <!-- / Layout wrapper -->
    <!-- Core JS -->
    <script src="{{ url('/') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery.countdown.min.js"></script>

    {{-- <script src="{{ url('/') }}/assets/vendor/js/menu.js"></script> --}}

    <!-- Main JS -->
    {{-- <script src="{{ url('/') }}/assets/js/main.js"></script> --}}

    <script type="text/javascript">
    const base_url = "{{ url('/') }}/";
    const sisaWaktu = "{{ $sisaWaktu }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted || 
        ( typeof window.performance != "undefined" && 
        window.performance.navigation.type === 2 );

        if ( historyTraversal ) {
            window.location.reload();
        }
    });

    load_detikan();

    function load_detikan() {
        let waktu_harus_selesai = sisaWaktu;
        let sisa_waktu = new Date().getTime() + (1000 * parseInt(waktu_harus_selesai));

        $('#countdown').countdown(sisa_waktu, function(event) {
            var totalHours = event.offset.totalDays * 24 + event.offset.hours;
            $(this).html(event.strftime(totalHours + ':%M:%S'));
        }).on('finish.countdown', function() {
            console.log('selesai');
            selesai();
        });
    }


    const soals = {!! json_encode($soals) !!};
    var soalAktif = 0;
    var totalSoal = soals.length;
    const idUjianPeserta = {{ $idUjianPeserta }};

    
    $("#tombolSelesai").hide();
    
    buka(soalAktif);
    showNavigator();

    // console.log(soals);

    function showNavigator() {
        let htmlNavigator = '<div class="d-flex justify-conten-between flex-wrap">';
        let noSoal = 0;
        soals.map(function(soal) {
            // htmlNavigator += '<a href="#" onclick="return buka('+(noSoal)+');" style="width: 40px; border: solid 1px #eee; margin-left: 5px; text-align: center; border-radius: 5px; padding: 2px 5px;">'+(100)+'</a>';

            let classSudahDijawab = '';
            if (soal.jawaban_peserta != null) {
                classSudahDijawab = 'class="bg-success"';
            }

            // consol
            htmlNavigator += '<a href="#" '+classSudahDijawab+' onclick="return bukakan('+(noSoal)+');" style="width: 40px; border: solid 1px #eee; margin-left: 5px; margin-bottom: 4px; text-align: center; border-radius: 5px; padding: 2px 5px;">'+(noSoal+1)+'</a>';

            noSoal++;
        });
        htmlNavigator += '</div>';

        // console.log(htmlNavigator);

        $("#navigatorSoal").html(htmlNavigator);
    }

    function buka(noSoal) {
        let isiSoal = soals[noSoal].soal;

        let gambarSoal = '';
        if (soals[noSoal].file_media != null) {
            gambarSoal += '<p><img src="'+soals[noSoal].file_media+'" width="100%"></p>';
        }
        
        $("#headerSoal").html("Soal nomor "+(noSoal+1));
        $("#contentSoal").html(gambarSoal +isiSoal);
        let idSoal = soals[noSoal].idSoal;
        let jawabanTerpilih = soals[noSoal].jawaban_peserta;
        
        let opsiSoal = '<div class="list-group my-2">';
        if (soals[noSoal].opsi.length > 0) {
            soals[noSoal].opsi.map(function(ops) {
                let checked = '';
                if (ops.id == jawabanTerpilih) {
                    checked = 'checked';
                }
                let gambarOpsi = '';
                if (ops.file_media != null) {
                    gambarOpsi += '<img src="'+ops.file_media+'">';
                }

                opsiSoal += 
                '<div class="list-group-item">'+
                    '<div class="d-flex align-item-start">'+
                        '<div style="margin-right: 10px">'+
                            '<input type="radio" name="opsi_'+noSoal+'" value="'+ops.id+'" id="opsi_'+ops.id+'" '+checked+' onchange="return saveJawaban('+noSoal+', '+idUjianPeserta+', '+idSoal+', '+ops.id+');">'+
                        '</div>'+
                        '<label for="opsi_'+ops.id+'">'+
                            ops.opsi+
                            '<br/>'+
                            gambarOpsi+
                        '</label>'+
                    '</div>'+
                '</div>'
                ;
            });
        }
        opsiSoal += '</div>';
        
        $("#opsiSoal").html(opsiSoal);

        // hide / show tombol next
        if ((noSoal+1) == totalSoal) {
            $("#tombolNext").hide();
            $("#tombolSelesai").show();
        } else {
            $("#tombolNext").show();
            $("#tombolSelesai").hide();
        }
        
        // hide / show tombol previos
        if ((noSoal-1) == -1) {
            $("#tombolPrev").hide();
        } else {
            $("#tombolPrev").show();
        }
    }

    function next() {
        if ((soalAktif+1) < totalSoal) {
            buka((soalAktif+1));
            soalAktif++;
        } 
    }


    function prev() {
        if ((soalAktif-1) >= 0) {
            buka((soalAktif-1));
            soalAktif--;
        }
    }

    function bukakan(noSoal) {
        soalAktif = noSoal;
        buka(noSoal);
    }

    function saveJawaban(noSoal, idUjianPeserta, idSoal, idOpsi) {
        // let formData = new FormData();
        // formData.append(noSoal, noSoal);
        // formData.append(idSoal, idSoal);
        // formData.append(idOpsi, idOpsi);
        soals[noSoal].jawaban_peserta = idOpsi;

        $.ajax({
            type: "POST",
            url: base_url + 'peserta/ujian/saveSatu',
            data: 'noSoal='+noSoal+'&idUjianPeserta='+idUjianPeserta+'&idSoal='+idSoal+'&idOpsi='+idOpsi,
            beforeSend: function()  {
                console.log('menyimpan...')
            },
            success: function(res) {
                next();
                showNavigator();
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function selesai(showConfirm=false) {
        if (showConfirm) {
            if (confirm('Anda sudah yakin dengan jawaban Anda?')) {
                window.location.href = base_url+'peserta/ujian/selesai/'+idUjianPeserta;
            }
        } else {
            window.location.href = base_url+'peserta/ujian/selesai/'+idUjianPeserta;
        }

        return false;
    }
    </script>
    </body>
</html>
