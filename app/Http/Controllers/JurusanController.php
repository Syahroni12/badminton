<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
public function index() {
    $title="Jurusan";
    $jurusan = Jurusan::with('fakultas')->orderBy('fakultas_id', 'asc')->get();

    $fakultas=Fakultas::all();
    return view('jurusan',compact('title','jurusan','fakultas'));
    
}
public function tambah_data(Request $request) {
    $validator = Validator::make($request->all(), [
        'fakultas_id' => 'required|integer|exists:fakultas,id',
        'nama_jurusan' => 'required',
     
    ]);
    if ($validator->fails()) {
        $messages = $validator->errors()->all();
        Alert::error($messages)->flash();
        return back()->withErrors($validator)->withInput();
    }

    $data=new Jurusan();
    $data->fakultas_id=$request->fakultas_id;
    $data->nama_jurusan=$request->nama_jurusan;
    $data->save();

    Alert::success("Succes","Berhasil Tambah Data jurusan");
    return back();
}
public function update_jurusan(Request $request) {
    $validator = Validator::make($request->all(), [
        'fakultas_id' => 'required|integer|exists:fakultas,id',
        'nama_jurusan' => 'required',
     
    ]);
    if ($validator->fails()) {
        $messages = $validator->errors()->all();
        Alert::error($messages)->flash();
        return back()->withErrors($validator)->withInput();
    }

    $data=Jurusan::find($request->id);
    $data->fakultas_id=$request->fakultas_id;
    $data->nama_jurusan=$request->nama_jurusan;
    $data->save();

    Alert::success("Succes","Berhasil Ubah Data jurusan");
    return back();
}

public function hapus_jurusan($id)  {
    $jurusan=Jurusan::find($id);
    $jurusan->delete();

      Alert::success("Succes","Berhasil Hapus data jurusan");
    return back();
}


public function getJurusanByFakultas($fakultas_id)
{
    // Mengambil data jurusan berdasarkan fakultas_id
    $jurusans = Jurusan::where('fakultas_id', $fakultas_id)->get();

    // Mengembalikan data dalam format JSON
    return response()->json($jurusans);
}

}
