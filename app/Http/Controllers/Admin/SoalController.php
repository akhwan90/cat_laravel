<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Soal;
use App\Models\SoalOpsi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SoalController extends Controller
{

    public function index()
    {
        $cari = request('q');

        $getData = Soal::orderBy('id', 'asc')
        ->select(
            'soal.*',
        );

        if (!empty($cari)) {
            $getData->where('soal', 'like', '%'.$cari.'%');
        }
        
        $getData = $getData->paginate(100);
        // $getData = $getData->toSql();

        // echo $getData;
        // exit;
        
        $data['datas'] = $getData;
        $data['menu_aktif'] = "admin.soal";

        return view('page.admin.soal.index', $data);
    }

    public function add()
    {
        $data['menu_aktif'] = "admin.soal";

        return view('page.admin.soal.add', $data);
    }

    public function edit($idSoal)
    {
        $getDataSoal = Soal::whereId($idSoal)->first();
        $data['dataSoal'] = $getDataSoal;
        $getDataSoalOpsi = SoalOpsi::where('soal_id', $idSoal)
        ->orderBy('id', 'asc')
        ->get();
        $data['dataSoalOpsi'] = $getDataSoalOpsi;
        
        $data['menu_aktif'] = "admin.soal";

        return view('page.admin.soal.edit', $data);
    }

    public function insert()
    {
        $validatedData = request()->validate([
            'soal' => 'required|min:3',
            'kunci' => 'required',
        ]);

        // insert soal 
        $insertSoalId = Soal::insertGetId([
            'soal'=>$validatedData['soal'],
            'created_at'=>Carbon::now()
        ]);
        
        $jawaban = request('jawaban');
        $kunci = request('kunci');
        
        $idKunciJawaban = null;
        for ($i=0; $i < count($jawaban); $i++) {
            $isKunci = ($kunci == $i) ? 1 : 0;

            $insertSoalJawaban = SoalOpsi::insertGetId([
                'soal_id'=>$insertSoalId,
                'opsi'=>$jawaban[$i],
                'is_kunci'=>$isKunci,
                'created_at'=>Carbon::now()
            ]);

            if ($kunci == $i) {
                $idKunciJawaban = $insertSoalJawaban;
            }
        }

        // update jawaban di tabel soal
        $updateKunciJawabanDiSoal = Soal::whereId($insertSoalId)
        ->update([
            'id_soal_kunci_jawaban'=>$idKunciJawaban
        ]);

        return redirect()->route('admin.soal.index');
    }

    public function update()
    {
        $validatedData = request()->validate([
            'id' => 'required',
            'soal' => 'required|min:3',
            'kunci' => 'required',
        ]);

        $id = request('id');
        $jawaban = request('jawaban');
        $kunci = request('kunci');
        $idSoalOpsi = request('id_soal_opsi');

        // insert soal 
        $updateSoal = Soal::whereId($id)->update([
            'soal' => $validatedData['soal'],
            'updated_at' => Carbon::now()
        ]);

        $idKunciJawaban = null;
        foreach ($idSoalOpsi as $opsiKey => $opsiVal) {
            $isKunci = ($kunci == $opsiVal) ? 1 : 0;

            $updateSoalJawaban = SoalOpsi::whereId($opsiVal)->update([
                'opsi' => $jawaban[$opsiVal],
                'is_kunci' => $isKunci,
                'created_at' => Carbon::now()
            ]);

            if ($kunci == $opsiVal) {
                $idKunciJawaban = $opsiVal;
            }
        }

        // update jawaban di tabel soal
        $updateKunciJawabanDiSoal = Soal::whereId($id)
        ->update([
            'id_soal_kunci_jawaban' => $idKunciJawaban
        ]);

        return redirect()->route('admin.soal.index');
    }
    
    public function remove($idUser)
    {
        $remove = Peserta::whereId($idUser)
        ->delete();
        return redirect()->route('admin.soal.index');
    }

    public function insertAdmin($idUser)
    {
        $getPeserta = Peserta::whereId($idUser)
        ->first();

        if ($getPeserta) {
            $insertToAdmin = User::insert([
                'name'=>$getPeserta->name,
                'email'=>$getPeserta->email,
                'password'=> Hash::make('peserta123!'),
                'created_at'=> Carbon::now(),
                'level'=>3,
            ]);
        }

        return redirect()->route('admin.soal.index');
    }
}
