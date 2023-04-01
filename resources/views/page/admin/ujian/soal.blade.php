@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Soal Ujian</h5>
    <div class="card-body">

        @include('page.admin.ujian.sub_menu')
        
        <a href="{{ route('admin.ujian.soal.add', $data->id) }}" class="btn btn-outline-primary">Tambah Soal</a>
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="80%">Soal</th>
                        <th width="10%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @if ($dataSoals->first() != null)
                        @foreach ($dataSoals as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->soal }}</td>
                                <td>
                                    <a href="{{ route('admin.ujian.soal.remove', [$data->id, $item->id]) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
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