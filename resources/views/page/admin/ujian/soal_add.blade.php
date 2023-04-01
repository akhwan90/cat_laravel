@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Soal Ujian</h5>
    <div class="card-body">

        @include('page.admin.ujian.sub_menu')
        
        <div class="table-responsive mt-2">
            <form action="{{ route('admin.ujian.soal.save') }}" method="post">
                @csrf
                {!! Form::hidden('ujian_id', $data->id) !!}

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="80%">Soal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @if ($dataSoals->first() != null)
                            @foreach ($dataSoals as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="soals[]" id="soal_{{ $item->id }}" value="{{ $item->id }}">    
                                    </td>
                                    <td>
                                        <label for="soal_{{ $item->id }}">
                                        {{ $item->soal }}
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