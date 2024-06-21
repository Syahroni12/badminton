<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(){
        $title="Data Anggota";
        $anggota = Anggota ::with('jurusan','user')->get();//berfungsi memanggil data anggota dengan nama relasi jurusan dan user
        return view('anggota.index', compact(['anggota','title']));
    }

    public function create(){
        return view('anggota.create');
    }

    public function store(Request $request){
        //dd($request->except(['_token','submit']));
        Anggota::create($request->except(['_token','submit']));
        return redirect('/anggota');
    }

    public function edit($id){
        $anggota = Anggota::find($id);
        return view('anggota.edit', compact(['anggota']));
    }

    public function update($id, Request $request){
        $anggota = Anggota::find($id);
        $anggota->update($request->except(['_token','submit']));
        return redirect('/anggota');
    }

    public function destroy($id){
        $anggota = Anggota::find($id);
        $anggota->delete();
        return redirect('/anggota');
    }
}
