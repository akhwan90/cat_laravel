<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $cari = request('q');

        $getData = User::orderBy('id', 'asc');
        if (!empty($cari)) {
            $getData->where('name', 'like', '%'.$cari.'%');
            $getData->orWhere('email', 'like', '%'.$cari.'%');
        }
        
        $getData = $getData->paginate(100);
        // $getData = $getData->toSql();

        // echo $getData;
        // exit;
        
        $data['datas'] = $getData;
        $data['menu_aktif'] = "admin.user";

        return view('page.admin.user.index', $data);
    }

    public function add()
    {
        $data['menu_aktif'] = "admin.user";

        return view('page.admin.user.add', $data);
    }

    public function edit($idUser)
    {
        $getData = User::whereId($idUser)->first();
        $data['data'] = $getData;
        $data['menu_aktif'] = "admin.user";

        return view('page.admin.user.edit', $data);
    }

    public function insert()
    {
        $validatedData = request()->validate([
            'email' => 'email|required|unique:users',
            'name' => 'required|max:255',
            'level' => 'required',
            'password' => 'required|min:6',
        ]);

        $pdata = [
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
            'level' => $validatedData['level'],
            'password'=> Hash::make($validatedData['password'])
        ];

        User::insert($pdata);

        return redirect()->route('admin.user.index');
    }

    public function update()
    {
        $validatedData = request()->validate([
            'name' => 'required|max:255',
            'level' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $update = [
            'name'=>request('name'),
            'level'=>request('level'),
        ];

        if (strlen(request('password')) > 5) {
            $update['password'] = Hash::make($validatedData['password']);

        }

        User::whereId(request('id'))
        ->update($update);

        return redirect()->route('admin.user.index');
    }
    
    public function remove($idUser)
    {
        $remove = User::whereId($idUser)
        ->delete();
        return redirect()->route('admin.user.index');
    }
}
