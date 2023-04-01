@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Peserta Ujian</h5>
    <div class="card-body">

        @include('page.admin.ujian.sub_menu')
        
        <div class="table-responsive mt-2">
            <form action="{{ route('admin.ujian.peserta.save') }}" method="post">
                @csrf
                {!! Form::hidden('ujian_id', $data->id) !!}

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="80%">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @if ($dataPesertas->first() != null)
                            @foreach ($dataPesertas as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="pesertas[]" id="peserta_{{ $item->id }}" value="{{ $item->id }}">    
                                    </td>
                                    <td>
                                        <label for="peserta_{{ $item->id }}">
                                        {{ $item->name }}
                                        </label>
                                    </td>
                                </tr>

                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <button class="btn btn-outline-primary mt-2" type="submit">Simpan</button>
            </form>
        </div>
        
    </div>
</div>
@endsection