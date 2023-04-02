@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Peserta Ujian</h5>
    <div class="card-body">

        @include('page.admin.ujian.sub_menu')
        
        <a href="{{ route('admin.ujian.peserta.add', $data->id) }}" class="btn btn-outline-primary">Tambah Peserta</a>
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="60%">Nama</th>
                        <th width="20%">Status</th>
                        <th width="10%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @if ($dataPesertas->first() != null)
                        @foreach ($dataPesertas as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="text-info">Belum dikerjakan</span>
                                    @elseif ($item->status == 1) 
                                        <span class="text-warning">Sedang dikerjakan</span>
                                    @elseif ($item->status == 2)
                                        <span class="text-success">Selesai dikerjakan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 1)

                                        <a href="{{ route('admin.ujian.peserta.remove', [$data->id, $item->id]) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
                                    @endif
                                </td>
                            </tr>

                            @php
                                $no++;
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection