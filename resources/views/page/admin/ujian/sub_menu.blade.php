<div class="my-2">
    <a href="{{ route('admin.ujian.detil', $data->id)}}" class="btn btn-outline-primary">Detil Ujian</a>
    <a href="{{ route('admin.ujian.peserta.index', $data->id)}}" class="btn btn-warning">Peserta</a>
    <a href="{{ route('admin.ujian.soal.index', $data->id)}}" class="btn btn-warning">Soal</a>
</div>