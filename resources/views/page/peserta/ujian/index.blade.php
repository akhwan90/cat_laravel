@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Daftar Ujian</h5>
    <div class="card-body">
        {!! session('notif') !!}
        
        <div class="row d-flex justify-content-between">
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
                <th width="60%">Nama</th>
                <th width="20%">Status</th>
                <th width="15%">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($datas as $item)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $item->nama_ujian }}</td>
                    <td>
                        @if ($item->status == 0)
                            Belum Dikerjakan
                        @elseif ($item->status == 1)
                            Sedang Dikerjakan
                        @elseif ($item->status == 2)
                            Selesai Dikerjakan
                        @endif    
                    </td>
                    <td>
                        <div class="btn-group">
                            @if ($item->status != 2)
                                <a href="{{ URL::to('peserta/ujian/ikuti/'.$item->id) }}" class="btn btn-outline-success btn-sm" target="_blank">Ikuti</a>
                            @endif
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