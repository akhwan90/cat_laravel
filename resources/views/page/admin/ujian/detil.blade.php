@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Detil Ujian</h5>
    <div class="card-body">

        @include('page.admin.ujian.sub_menu')

        <p>
            <label for="">Nama Ujian</label><br/>
            {{ $data->nama_ujian }}
        </p>
        <p>
            <label for="">Status Ujian</label><br/>
            @if ($data->status == 1)
                <span class="text-success">Aktif</span>
            @else 
                <span class="text-muted">Non Aktif</span>
            @endif
        </p>
        <p>
            <label for="">Waktu Pengerjaan</label><br/>
            {{ $data->waktu }} menit
        </p>
    </div>
</div>
@endsection