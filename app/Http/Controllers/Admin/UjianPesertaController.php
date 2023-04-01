<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Ujian;
use App\Models\UjianPeserta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UjianPesertaController extends Controller
{

    public function index($id)
    {
        $getData = Ujian::whereId($id)->first();
        $data['data'] = $getData;

        $getDataPeserta = UjianPeserta::where('ujian_peserta.ujian_id', $id)
            ->join('peserta', 'ujian_peserta.peserta_id', '=', 'peserta.id')
            ->select(
                'ujian_peserta.*',
                'peserta.name AS nama_peserta',
            )
            ->get();

        $data['dataPesertas'] = $getDataPeserta;
        $data['menu_aktif'] = "admin.ujian";

        return view('page.admin.ujian.peserta', $data);
    }

    public function add($idUjian)
    {
        $data['menu_aktif'] = "admin.ujian";
        $getData = Ujian::whereId($idUjian)->first();
        $data['data'] = $getData;

        $getDataPeserta = Peserta::orderBy('peserta.name', 'asc')
        ->whereNull('ujian_peserta.peserta_id')
        ->leftJoin('ujian_peserta', 'ujian_peserta.peserta_id', '=', 'peserta.id')
        ->select(
            'peserta.*',
        )
        ->get();

        $data['dataPesertas'] = $getDataPeserta;

        return view('page.admin.ujian.peserta_add', $data);
    }

    public function save()
    {
        $validatedData = request()->validate([
            'ujian_id' => 'required',
        ]);

        foreach (request('pesertas') as $peserta) {
            $pdata = [
                'ujian_id' => $validatedData['ujian_id'],
                'peserta_id'=>$peserta
            ];

            UjianPeserta::insert($pdata);
        }

        return redirect()->route('admin.ujian.peserta.index', $validatedData['ujian_id']);
    }
    
    public function remove($idUjian, $idUjianPeserta)
    {
        $remove = UjianPeserta::whereId($idUjianPeserta)
        ->delete();
        return redirect()->route('admin.ujian.peserta.index',$idUjian);
    }
}
