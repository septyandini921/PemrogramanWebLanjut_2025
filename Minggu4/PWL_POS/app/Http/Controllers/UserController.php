<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        //Prak 1
        // //tambah data dengan Eloquent Model_Prak 1
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data); //update data user

        // //mencoba mengakses UserModel
        // $user = UserModel::all(); //ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);

        //Prak 2.1 No 1
        // $user = UserModel::find(1); //mencari data dengan id 1
        // return view('user', ['data' => $user]);

        //Prak 2,1 No 4
        // $user = UserModel::where('level_id', 1)->first();
        // return view('user', ['data' => $user]);

        //Prak 2,1 No 6
        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        //Prak 2,1 No 8
        // $user = UserModel::findOr(1, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        //Prak 2.1 No 10 (Not found)
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        //Prak 2.2 No 1
        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => $user]);

        //Prak 2.2 No 3 (Not found)
        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user', ['data' => $user]);
    }
}
