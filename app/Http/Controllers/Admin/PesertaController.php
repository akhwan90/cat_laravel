<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{

    public function index()
    {
        $cari = request('q');

        $getData = Peserta::orderBy('id', 'asc')
        ->leftJoin('users', 'peserta.email', '=', 'users.email')
        ->select(
            'peserta.*',
            'users.id AS user_id'
        );

        if (!empty($cari)) {
            $getData->where('name', 'like', '%'.$cari.'%');
        }
        
        $getData = $getData->paginate(100);
        // $getData = $getData->toSql();

        // echo $getData;
        // exit;
        
        $data['datas'] = $getData;
        $data['menu_aktif'] = "admin.peserta";

        return view('page.admin.peserta.index', $data);
    }

    public function add()
    {
        $data['menu_aktif'] = "admin.peserta";

        return view('page.admin.peserta.add', $data);
    }

    public function edit($idUser)
    {
        $getData = Peserta::whereId($idUser)->first();
        $data['data'] = $getData;
        $data['menu_aktif'] = "admin.peserta";

        return view('page.admin.peserta.edit', $data);
    }

    public function insert()
    {
        $validatedData = request()->validate([
            'email' => 'email|required|unique:peserta',
            'name' => 'required|max:255',
        ]);

        $pdata = [
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
        ];

        Peserta::insert($pdata);

        return redirect()->route('admin.peserta.index');
    }

    public function update()
    {
        $validatedData = request()->validate([
            'id' => 'required',
            'name' => 'required|max:255',
        ]);

        $update = [
            'name'=>$validatedData['name'],
        ];

        Peserta::whereId($validatedData['id'])
        ->update($update);

        return redirect()->route('admin.peserta.index');
    }
    
    public function remove($idUser)
    {
        $remove = Peserta::whereId($idUser)
        ->delete();
        return redirect()->route('admin.peserta.index');
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

        return redirect()->route('admin.peserta.index');
    }
}
