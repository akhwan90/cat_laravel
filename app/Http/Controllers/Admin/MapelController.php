<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Peserta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MapelController extends Controller
{

    public function index()
    {
        $cari = request('q');

        $getData = Mapel::orderBy('id', 'asc')
        ->select(
            'mapel.*',
        );

        if (!empty($cari)) {
            $getData->where('name', 'like', '%'.$cari.'%');
        }
        
        $getData = $getData->paginate(100);
        // $getData = $getData->toSql();

        // echo $getData;
        // exit;
        
        $data['datas'] = $getData;
        $data['menu_aktif'] = "admin.mapel";

        return view('page.admin.mapel.index', $data);
    }

    public function add()
    {
        $data['menu_aktif'] = "admin.mapel";

        return view('page.admin.mapel.add', $data);
    }

    public function edit($idMapel)
    {
        $getData = Mapel::whereId($idMapel)->first();
        $data['data'] = $getData;
        $data['menu_aktif'] = "admin.mapel";

        return view('page.admin.mapel.edit', $data);
    }

    public function insert()
    {
        $validatedData = request()->validate([
            'name' => 'required|max:255',
        ]);

        $pdata = [
            'name' => $validatedData['name'],
            'created_at'=>Carbon::now()
        ];

        Mapel::insert($pdata);

        return redirect()->route('admin.mapel.add');
    }

    public function update()
    {
        $validatedData = request()->validate([
            'id' => 'required',
            'name' => 'required|max:255',
        ]);

        $update = [
            'name'=>$validatedData['name'],
            'updated_at'=>Carbon::now()
        ];

        Mapel::whereId($validatedData['id'])
        ->update($update);

        return redirect()->route('admin.mapel.index');
    }
    
    public function remove($idMapel)
    {
        $remove = Mapel::whereId($idMapel)
        ->delete();
        return redirect()->route('admin.mapel.index');
    }

}
