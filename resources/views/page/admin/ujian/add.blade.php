@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Add Ujian</h5>
    <div class="card-body">
        <form action="{{ route('admin.ujian.insert') }}" method="post">
            @csrf

            @if ($errors->first())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="form-group">
                <label for="">Ujian</label>
                {!! Form::text('nama_ujian', '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="">Status</label>
                {!! Form::select('status', ['1'=>'Aktif', '0'=>'Non Aktif'], '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="">Waktu Mengerjakan (Dalam Menit)</label>
                {!! Form::number('waktu', '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group mt-2">
                <button class="btn btn-outline-primary" type="submit">Simpan</button>
                <a href="{{ route('admin.ujian.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection