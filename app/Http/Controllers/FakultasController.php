<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FakultasController extends Controller
{
    public function index()
    {
        $title = 'Fakultas';
        $fakultas = Fakultas::all();
        return view('fakultas', compact('fakultas', 'title'));
    }
    public function tambah_data(Request $request)
    {
        $data = ["nama_fakultas" => $request->nama_fakultas];

        Fakultas::create($data);
        Alert::success('Success Title', 'Berhasil Tambah Data');//menampilkan notifikasi dengan sweetalert plugin
        return back();
    }
    public function update_data(Request $request)
    {
        $data = Fakultas::find($request->id);
        $data->nama_fakultas = $request->nama_fakultas;
        $data->save();

        Alert::success('Success Title', 'Berhasil Update Data');
        return back();
    }

    public function hapus_data($id)
    {
        $data = Fakultas::find($id);
        $data->delete();

        Alert::success('Success Hapus', 'Berhasil Hapus Data');
        return back();
    }
}
