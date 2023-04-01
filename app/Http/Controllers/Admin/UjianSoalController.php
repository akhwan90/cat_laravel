<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\UjianSoal;
use Carbon\Carbon;

class UjianSoalController extends Controller
{

    public function index($id)
    {
        $getData = Ujian::whereId($id)->first();
        $data['data'] = $getData;

        $getDataSoal = UjianSoal::where('ujian_soal.ujian_id', $id)
            ->join('soal', 'ujian_soal.soal_id', '=', 'soal.id')
            ->select(
                'ujian_soal.*',
                'soal.soal',
            )
            ->get();

        $data['dataSoals'] = $getDataSoal;
        $data['menu_aktif'] = "admin.ujian";

        return view('page.admin.ujian.soal', $data);
    }

    public function add($idUjian)
    {
        $data['menu_aktif'] = "admin.ujian";
        $getData = Ujian::whereId($idUjian)->first();
        $data['data'] = $getData;

        $getDataSoal = Soal::orderBy('soal.id', 'asc')
        ->whereNull('ujian_soal.soal_id')
        ->leftJoin('ujian_soal', 'ujian_soal.soal_id', '=', 'soal.id')
        ->select(
            'soal.*',
        )
        ->get();

        $data['dataSoals'] = $getDataSoal;

        return view('page.admin.ujian.soal_add', $data);
    }

    public function save()
    {
        $validatedData = request()->validate([
            'ujian_id' => 'required',
        ]);

        foreach (request('soals') as $peserta) {
            $pdata = [
                'ujian_id' => $validatedData['ujian_id'],
                'soal_id'=>$peserta,
                'created_at'=>Carbon::now()
            ];

            UjianSoal::insert($pdata);
        }

        return redirect()->route('admin.ujian.soal.index', $validatedData['ujian_id']);
    }
    
    public function remove($idUjian, $idUjianSoal)
    {
        $remove = UjianSoal::whereId($idUjianSoal)
        ->delete();
        return redirect()->route('admin.ujian.soal.index',$idUjian);
    }
}
