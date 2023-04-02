@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Add Mata Pelajaran</h5>
    <div class="card-body">
        <form action="{{ route('admin.mapel.insert') }}" method="post">
            @csrf

            @if ($errors->first())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="form-group">
                <label for="">Nama</label>
                {!! Form::text('name', '', ['class'=>'form-control', 'autofocus'=>true]) !!}
            </div>
            <div class="form-group mt-2">
                <button class="btn btn-outline-primary" type="submit">Simpan</button>
                <a href="{{ route('admin.mapel.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection