@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Mata Pelajaran</h5>
    <div class="card-body">
        <form action="{{ route('admin.mapel.update') }}" method="post">
            @csrf
            {!! Form::hidden('id', $data->id) !!}

            @if ($errors->first())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="form-group">
                <label for="">Nama</label>
                {!! Form::text('name', $data->name, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group mt-2">
                <button class="btn btn-outline-primary" type="submit">Simpan</button>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection