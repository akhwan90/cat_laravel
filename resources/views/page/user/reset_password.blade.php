@extends('layouts.depan')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Reset Password</span>
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Reset Password User</h5>
                <div class="card-body">
                    @if (!empty($errors->first()))
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    @if (!empty(session('notif')))
                        {!! session('notif') !!}
                    @endif

                    <form action="/resetPassword" method="POST">
                        @csrf
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="old_password" id="password" required
                                placeholder="Password">
                            <label for="password">Password Lama</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="new_password" id="password" required
                                placeholder="Password">
                            <label for="password">Password Baru</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="new_password_confirmation" id="password" required
                                placeholder="Password">
                            <label for="password">Ulangi Password Baru</label>
                        </div>
    
                        <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection