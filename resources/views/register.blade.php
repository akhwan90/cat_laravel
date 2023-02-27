@extends('layouts.depan')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pendaftaran User</span>
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Pendaftaran User</h5>
                <div class="card-body">
                    @if (!empty($errors->first()))
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    @if (!empty(session('notif')))
                        {!! session('notif') !!}
                    @endif

                    <form action="/register" method="POST">
                        @csrf
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="name" id="name" required
                                value="{{ old('name') }}" placeholder="Name">
                            <label for="name">Nama</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="email" class="form-control" name="email" id="email" required
                                value="{{ old('email') }}" placeholder="name@example.com">
                            <label for="email">Alamat Email</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="password" id="password" required
                                placeholder="Password">
                            <label for="password">Password</label>
                        </div>
    
                        <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Register</button>
                    </form>
                    <small class="d-block mt-3">Have an account? <a class="text-danger" href="/login"> Login Here</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection