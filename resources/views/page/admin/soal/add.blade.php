@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Add Soal</h5>
    <div class="card-body">
        <form action="{{ route('admin.soal.insert') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->first())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="card card-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Mata Pelajaran</label>
                        {!! Form::select('mapel_id', $pMapel, '', ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            
            <div class="card card-body mt-2">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="">Soal</label>
                            {!! Form::text('soal', '', ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Gambar Soal</label>
                            <input type="file" name="soal_gambar" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>

            @for ($i = 0; $i < 2; $i++)
            <div class="card card-body mt-2">
                <div class="row">
                    <div class="col-lg-1">
                        <label for="">Kunci ?</label>
                        <input type="radio" name="kunci" value="{{ $i }}">
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            {!! Form::text('jawaban['.$i.']', '', ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Gambar Jawaban</label>
                            <input type="file" name="jawaban_gambar[{{ $i }}]" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
            @endfor
            
            <div class="form-group mt-2">
                <button class="btn btn-outline-primary" type="submit">Simpan</button>
                <a href="{{ route('admin.soal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection