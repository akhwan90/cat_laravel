@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Daftar Ujian</h5>
    <div class="card-body">
        <a href="{{ route('admin.ujian.add') }}" class="btn btn-outline-primary mb-2">Tambah</a>
        {!! session('notif') !!}
        
        <div class="row d-flex justify-content-between">
            <div class="col-auto">
                {{ $datas->withQueryString()->links() }}
            </div>
            <div class="col-auto row align-items-center">
                    <div class="col-auto">
                        <label for="">Pencarian</label>
                    </div>
                    <div class="col-auto">
                        <form action="" method="get">
                            <div class="col-auto input-group mb-3">
                                
                                <input type="search" name="q" class="form-control" placeholder="keyword" value="{{ request('q') }}">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead>
            <tr>
                <th width="5%">No</th>
                <th width="50%">Nama</th>
                <th width="10%">Status</th>
                <th width="35%">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <?php $no = $datas->firstItem(); ?>
                @foreach ($datas as $item)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $item->nama_ujian }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ URL::to('admin/ujian/edit/'.$item->id) }}" class="btn btn-outline-success btn-sm">Edit</a>
                            {{-- <a href="{{ URL::to('admin/ujian/remove/'.$item->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Anda yakin..?');">Hapus</a> --}}
                            <a href="{{ URL::to('admin/ujian/detil/'.$item->id) }}" class="btn btn-outline-info btn-sm">Detil</a>
                        </div>
                    </td>
                </tr>    
                <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection