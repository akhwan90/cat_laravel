<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Peserta;
use App\Models\Soal;
use App\Models\SoalOpsi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $data['pMapel'] = Mapel::pluck('name', 'id')->toArray();
        
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
        $data['pMapel'] = Mapel::pluck('name', 'id')->toArray();
        
        $data['menu_aktif'] = "admin.soal";

        return view('page.admin.soal.edit', $data);
    }

    public function insert()
    {
        $validatedData = request()->validate([
            'soal' => 'required|min:3',
            'kunci' => 'required',
            'mapel_id' => 'required',
            'soal_gambar'=>'image|max:512|mimes:jpeg,jpg,png'
        ]);

        $pDataSoal = [
            'mapel_id' => $validatedData['mapel_id'],
            'soal' => $validatedData['soal'],
            'created_at' => Carbon::now()
        ];

        // dd(request()->hasFile('jawaban_gambar[]'));
        // dd(request()->file('jawaban_gambar[0]'));

        // $jawabanGambar = request()->hasFile('jawaban_gambar');        
        $jawabanGambar = request()->file('jawaban_gambar');        

        // dd($jawabanGambar[0]);

        if (request()->hasFile('soal_gambar')) {
            $fileGambarSoal = request()->file('soal_gambar');
            $extensiGambarSoal = $fileGambarSoal->getClientOriginalExtension();

            $namaFileSoal = Str::random(16).".". $extensiGambarSoal;
            $fileGambarSoal->move(public_path() . '/upload/soal/', $namaFileSoal);
            
            $pDataSoal['file_media'] = $namaFileSoal;
            $pDataSoal['file_media_type'] = Str::lower($extensiGambarSoal);
        }

        // insert soal 
        $insertSoalId = Soal::insertGetId($pDataSoal);
        
        $jawaban = request('jawaban');
        $kunci = request('kunci');
        

        $idKunciJawaban = null;
        for ($i=0; $i < count($jawaban); $i++) {
            $isKunci = ($kunci == $i) ? 1 : 0;

            $pDataOpsi = [
                'soal_id' => $insertSoalId,
                'opsi' => $jawaban[$i],
                'is_kunci' => $isKunci,
                'created_at' => Carbon::now()
            ];

            // if (request()->hasFile('jawaban_gambar['.$i.']')) {
                
            if (!empty($jawabanGambar[$i])) {
                $fileGambarOpsi = $jawabanGambar[$i];
                $extensiGambarOpsi = $fileGambarOpsi->getClientOriginalExtension();

                $namaFileGambarOpsi = Str::random(16) . "." . $extensiGambarOpsi;
                $fileGambarOpsi->move(public_path() . '/upload/opsi/', $namaFileGambarOpsi);

                $pDataOpsi['file_media'] = $namaFileGambarOpsi;
                $pDataOpsi['file_media_type'] = Str::lower($extensiGambarOpsi);
            }
            // }   

            $insertSoalJawaban = SoalOpsi::insertGetId($pDataOpsi);

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
            'mapel_id' => 'required',
            'soal_gambar'=>'image|max:512|mimes:jpeg,jpg,png'
        ]);

        $id = request('id');
        $jawaban = request('jawaban');
        $kunci = request('kunci');
        $idSoalOpsi = request('id_soal_opsi');

        $jawabanGambar = request()->file('jawaban_gambar');
        
        // dd($jawabanGambar);

        $pDataSoal = [
            'mapel_id' => $validatedData['mapel_id'],
            'soal' => $validatedData['soal'],
            'updated_at' => Carbon::now()
        ];

        $getImageSoalSebelumnya = Soal::whereId($id)
        ->select('file_media')->first();

        // insert soal 
        if (request()->hasFile('soal_gambar')) {
            $fileGambarSoal = request()->file('soal_gambar');
            $extensiGambarSoal = $fileGambarSoal->getClientOriginalExtension();

            $namaFileSoal = Str::random(16) . "." . $extensiGambarSoal;
            $fileGambarSoal->move(public_path() . '/upload/soal/', $namaFileSoal);

            // hapus file sebelumnya
            @unlink(public_path().'/upload/soal/'.$getImageSoalSebelumnya->file_media);

            $pDataSoal['file_media'] = $namaFileSoal;
            $pDataSoal['file_media_type'] = Str::lower($extensiGambarSoal);
        }
        
        $updateSoal = Soal::whereId($id)->update($pDataSoal);

        $idKunciJawaban = null;
        foreach ($idSoalOpsi as $opsiKey => $opsiVal) {
            $isKunci = ($kunci == $opsiVal) ? 1 : 0;

            $pDataOpsi = [
                'opsi' => $jawaban[$opsiVal],
                'is_kunci' => $isKunci,
                'created_at' => Carbon::now()
            ];

            $getFileImageOpsiSebelumnya = SoalOpsi::whereId($opsiVal)
            ->select('file_media')->first();

            if (!empty($jawabanGambar[$opsiVal])) {
                $fileGambarOpsi = $jawabanGambar[$opsiVal];
                $extensiGambarOpsi = $fileGambarOpsi->getClientOriginalExtension();

                $namaFileGambarOpsi = Str::random(16) . "." . $extensiGambarOpsi;
                $fileGambarOpsi->move(public_path() . '/upload/opsi/', $namaFileGambarOpsi);

                // hapus file sebelumnya
                @unlink(public_path() . '/upload/opsi/' . $getFileImageOpsiSebelumnya->file_media);

                $pDataOpsi['file_media'] = $namaFileGambarOpsi;
                $pDataOpsi['file_media_type'] = Str::lower($extensiGambarOpsi);
            }

            $updateSoalJawaban = SoalOpsi::whereId($opsiVal)->update($pDataOpsi);

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

    public function getGambarSoal($idSoal)
    {
        $getFile = Soal::where('id', $idSoal)
        ->select(
            'file_media',
            'file_media_type',
        )
        ->first();

        if (is_file(public_path().'/upload/soal/'.$getFile->file_media)) {
            return response()->file(public_path() . '/upload/soal/' . $getFile->file_media);
        } else {
            echo 'File tidak ada';
        }
    }
}
