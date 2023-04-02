<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\Ujian;
use App\Models\UjianPeserta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UjianController extends Controller
{

    public function index()
    {
        $cari = request('q');

        $getData = Ujian::orderBy('id', 'asc')
        ->select(
            'ujian.*',
        );

        if (!empty($cari)) {
            $getData->where('nama_ujian', 'like', '%'.$cari.'%');
        }
        
        $getData = $getData->paginate(100);
        // $getData = $getData->toSql();

        // echo $getData;
        // exit;
        
        $data['datas'] = $getData;
        $data['menu_aktif'] = "admin.ujian";

        return view('page.admin.ujian.index', $data);
    }

    public function add()
    {
        $data['menu_aktif'] = "admin.ujian";

        return view('page.admin.ujian.add', $data);
    }

    public function edit($id)
    {
        $getData = Ujian::whereId($id)->first();
        $data['data'] = $getData;
        $data['menu_aktif'] = "admin.ujian";

        return view('page.admin.ujian.edit', $data);
    }

    public function insert()
    {
        $validatedData = request()->validate([
            'nama_ujian' => 'required|max:255',
            'waktu' => 'required',
        ]);

        $pdata = [
            'nama_ujian' => $validatedData['nama_ujian'],
            'waktu' => $validatedData['waktu'],
            'created_at'=>Carbon::now()
        ];

        Ujian::insert($pdata);

        return redirect()->route('admin.ujian.index');
    }

    public function update()
    {
        $validatedData = request()->validate([
            'id' => 'required',
            'nama_ujian' => 'required|max:255',
            'waktu' => 'required',
        ]);

        $update = [
            'nama_ujian'=>$validatedData['nama_ujian'],
            'status'=>request('status'),
            'waktu'=>$validatedData['waktu'],
            'updated_at'=>Carbon::now()
        ];

        Ujian::whereId($validatedData['id'])
        ->update($update);

        return redirect()->route('admin.ujian.index');
    }
    
    public function remove($id)
    {
        $remove = Ujian::whereId($id)
        ->delete();
        return redirect()->route('admin.ujian.index');
    }

    public function detil($id)
    {
        $getData = Ujian::whereId($id)->first();
        $data['data'] = $getData;
        $data['menu_aktif'] = "admin.ujian";

        return view('page.admin.ujian.detil', $data);    
    }
}
