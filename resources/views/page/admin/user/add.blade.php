@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Add User</h5>
    <div class="card-body">
        <form action="{{ route('admin.user.insert') }}" method="post">
            @csrf

            @if ($errors->first())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="form-group">
                <label for="">Email</label>
                {!! Form::text('email', '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                {!! Form::text('name', '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="">Password</label>
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label for="">Level</label>
                {!! Form::select('level', ['1'=>'Super Admin', '2'=>'Asesor','3'=>'Peserta'], '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group mt-2">
                <button class="btn btn-outline-primary" type="submit">Simpan</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection