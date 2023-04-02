<?php
namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Soal;
use App\Models\SoalOpsi;
use App\Models\Ujian;
use App\Models\UjianPeserta;
use App\Models\UjianPesertaJawaban;
use App\Models\UjianSoal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UjianController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;

        $getDataUjian = UjianPeserta::where('users.id', $idUser)
            ->join('peserta', 'ujian_peserta.peserta_id', '=', 'peserta.id')
            ->join('users', 'peserta.email', '=', 'users.email')
            ->join('ujian', 'ujian_peserta.ujian_id', '=', 'ujian.id')
            ->select(
                // 'ujian_peserta.*',
                'ujian.id',
                'ujian.nama_ujian',
                'ujian_peserta.status'
            )
            ->get();

        $data['datas'] = $getDataUjian;
        $data['menu_aktif'] = "peserta.ujian";

        return view('page.peserta.ujian.index', $data);
    }

    public function ikuti($idUjian)
    {
        $idUser = Auth::user()->id;

        $getDataUjian = UjianPeserta::where('users.id', $idUser)
            ->where('ujian_peserta.ujian_id', $idUjian)
            ->join('peserta', 'ujian_peserta.peserta_id', '=', 'peserta.id')
            ->join('users', 'peserta.email', '=', 'users.email')
            ->join('ujian', 'ujian_peserta.ujian_id', '=', 'ujian.id')
            ->select(
                'ujian_peserta.*',
                'ujian.waktu AS waktu_pengerjaan'
            )
            ->first();
        
        // echo $getDataUjian->status;
        // exit;

        if ($getDataUjian->status == 0) {
            $updateStatusUjian = UjianPeserta::whereId($getDataUjian->id)
            ->update([
                'status'=>1,
                'mulai_dikerjakan'=>Carbon::now(),
                'selesai_dikerjakan'=> Carbon::now()->addMinutes($getDataUjian->waktu_pengerjaan),
                'last_activity'=>Carbon::now(),
            ]);

            // insert soal 
            $getSoalUjian = UjianSoal::where('ujian_soal.ujian_id', $getDataUjian->ujian_id)
            ->join('soal', 'ujian_soal.soal_id', '=', 'soal.id')
            ->orderBy('ujian_soal.id', 'asc')
            ->select('soal.*')
            ->get();

            if (!empty($getSoalUjian)) {
                foreach ($getSoalUjian as $soal) {
                    $insertUjianPesertaJawaban = UjianPesertaJawaban::insert([
                        'ujian_peserta_id'=>$getDataUjian->id,
                        'soal_id'=>$soal->id,
                        'id_soal_opsi_kunci_jawaban'=>$soal->id_soal_kunci_jawaban,
                        'id_soal_opsi_jawaban'=>null,
                        'nilai'=>0,
                        'created_at'=>Carbon::now()
                    ]);
                }
            }

            return redirect()->route('peserta.ujian.viewSoal', $getDataUjian->id);
        } elseif ($getDataUjian->status == 1) {
            return redirect()->route('peserta.ujian.viewSoal', $getDataUjian->id);
        } else if ($getDataUjian->status == 2) {
            return redirect()->route('peserta.ujian.index');
        }

        // dd($getDataUjian);
        
    }

    public function viewSoal($idUjianPeserta)
    {

        $getDetilUjianPeserta = UjianPeserta::whereId($idUjianPeserta)
            ->select('selesai_dikerjakan', 'status')
            ->first();

        if ($getDetilUjianPeserta->status == 2) {
            return redirect()->route('peserta.ujian.index');
        }

        $getSoal = UjianPesertaJawaban::where('ujian_peserta_jawaban.ujian_peserta_id', $idUjianPeserta)
        ->join('soal', 'ujian_peserta_jawaban.soal_id', '=', 'soal.id')
        ->select(
            'soal.id AS idSoal',
            'soal.soal',
            'soal.file_media',
            'ujian_peserta_jawaban.id_soal_opsi_jawaban AS jawaban_peserta'
        )
        ->get();

        $waktu_sekarang = new \DateTime(date('Y-m-d H:i:s'));
        $waktu_harus_selesai = new \DateTime($getDetilUjianPeserta['selesai_dikerjakan']);

        $diff = date_diff($waktu_harus_selesai, $waktu_sekarang);

        if ($diff->invert < 1) {
            $data['sisaWaktu'] = 0;
        } else {
            $data['sisaWaktu'] = (($diff->h * 60 * 60) + ($diff->i * 60) + $diff->s);
        }
        
        $tampungSoal = [];
        if (!empty($getSoal)) {
            foreach ($getSoal as $soal) {
                // $idx = $soal->id;
                // $tampungSoal[$idx] = $soal;
                $soal = $soal->toArray();

                // Log::info("opsi".$getOpsiJawaban);
                // cek file soal 
                $cekFileSoal = null;
                if (is_file(public_path().'/upload/soal/'.$soal['file_media'])) {
                    $cekFileSoal = url('peserta/ujian/viewGambarSoal/' . $soal['idSoal']);
                }
                $soal['file_media'] = $cekFileSoal;

                $getOpsiJawaban = SoalOpsi::where('soal_id', $soal['idSoal'])
                    ->orderBy('id')
                    ->get();

                $tampungOpsi = [];
                if ($getOpsiJawaban->first() != null) {
                    foreach ($getOpsiJawaban as $opsiJawaban) {
                        $opsiJawaban = $opsiJawaban->toArray();
                        $cekFileOpsi = null;
                        if (is_file(public_path() . '/upload/opsi/' . $opsiJawaban['file_media'])) {
                            $cekFileOpsi =
                            url('peserta/ujian/viewGambarOpsi/' . $opsiJawaban['id']);
                        }
                        $opsiJawaban['file_media'] = $cekFileOpsi;

                        $tampungOpsi[] = $opsiJawaban;
                    }
                }


                $soal['opsi'] = $tampungOpsi;

                $tampungSoal[] = $soal;
            }
        }

        // dd($tampungSoal);
        
        $data['soals'] = $tampungSoal;
        $data['idUjianPeserta'] = $idUjianPeserta;
        // dd($getSoal);

        return view('page.peserta.ujian.view_soal', $data);
    }

    public function saveSatu()
    {
        $idUjianPeserta = request('idUjianPeserta');
        $idSoal = request('idSoal');
        $idOpsiJawaban = request('idOpsi');

        // get detil jawaban 
        $getJawaban = UjianPesertaJawaban::where('ujian_peserta_id', $idUjianPeserta)
        ->where('soal_id', $idSoal)
        ->first();

        if ($getJawaban!=null) {
            // cek jawaban = kunci 
            $statusJawaban = 0;
            if ($getJawaban->id_soal_opsi_kunci_jawaban == $idOpsiJawaban) {
                $statusJawaban = 1;
            }

            $updateStatusJawaban = UjianPesertaJawaban::where('ujian_peserta_id', $idUjianPeserta)
            ->where('soal_id', $idSoal)
            ->update([
                'id_soal_opsi_jawaban'=>$idOpsiJawaban,
                'nilai'=>$statusJawaban,
                'updated_at'=>Carbon::now()
            ]);
        }

        return response()->json(['success'=>true]);
    }

    public function selesai($idUjianPeserta)
    {
        $getNilai = UjianPesertaJawaban::where('ujian_peserta_id', $idUjianPeserta)
        ->sum('nilai');

        // echo 'Nilai: '.$getNilai;
        // exit;

        $updateStatusUjian = UjianPeserta::whereId($idUjianPeserta)
        ->update([
            'status'=>2,
            'selesai_dikerjakan_sebenarnya'=>Carbon::now(),
            'nilai'=>$getNilai,
        ]);

        return redirect()->route('peserta.ujian.index');
    }

    public function viewGambarSoal($idSoal)
    {
        $getGambar = Soal::whereId($idSoal)
        ->select('file_media')
        ->first();

        if (is_file(public_path() . '/upload/soal/' . $getGambar->file_media)) {
            return response()->file(public_path().'/upload/soal/'.$getGambar->file_media);
        } else {
            abort(404);
        }
    }

    public function viewGambarOpsi($idOpsi)
    {
        $getGambar = SoalOpsi::whereId($idOpsi)
            ->select('file_media')
            ->first();

        if (is_file(public_path() . '/upload/opsi/' . $getGambar->file_media)) {
            return response()->file(public_path() . '/upload/opsi/' . $getGambar->file_media);
        } else {
            abort(404);
        }
    }
}