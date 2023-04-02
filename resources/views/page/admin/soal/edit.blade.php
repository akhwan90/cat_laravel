@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Soal</h5>
    <div class="card-body">
        <form action="{{ route('admin.soal.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $dataSoal->id }}">

            @if ($errors->first())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            
            <div class="card card-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Mata Pelajaran</label>
                        {!! Form::select('mapel_id', $pMapel, $dataSoal->mapel_id, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            
            <div class="card card-body mt-2">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="">Soal</label>
                            {!! Form::text('soal', $dataSoal->soal, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            @if (is_file(public_path().'/upload/soal/'.$dataSoal->file_media))
                                <img src="{{ url('upload/soal/'.$dataSoal->file_media) }}" style="width: 100%">
                            @endif
                            <label for="">Ganti Gambar Soal</label>
                            <input type="file" name="soal_gambar" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($dataSoalOpsi as $opsi)
            @php
                $opsiChecked = ($opsi->is_kunci == 1) ? 'checked' : '';
            @endphp
            <div class="card card-body mt-2">
                <div class="row">
                    <input type="hidden" name="id_soal_opsi[{{ $opsi->id }}]" value="{{ $opsi->id }}">
                    <div class="col-lg-1">
                        <label for="">Kunci ?</label>
                        <input type="radio" name="kunci" value="{{ $opsi->id }}" {!! $opsiChecked !!}>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            {!! Form::text('jawaban['.$opsi->id.']', $opsi->opsi, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            @if (is_file(public_path().'/upload/opsi/'.$opsi->file_media))
                                <img src="{{ url('upload/opsi/'.$opsi->file_media) }}" style="width: 100%">
                            @endif
                            <label for="">Ganti Gambar Jawaban</label>
                            <input type="file" name="jawaban_gambar[{{ $opsi->id }}]" class="form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            <div class="form-group mt-2">
                <button class="btn btn-outline-primary" type="submit">Simpan</button>
                <a href="{{ route('admin.soal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection