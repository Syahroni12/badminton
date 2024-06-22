<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Fakultas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    public function index(){
        $title="Data Anggota";
        $anggota = Anggota ::with('jurusan.fakultas','user')->get();//berfungsi memanggil data anggota dengan nama relasi jurusan dan user
        return view('anggota.index', compact(['anggota','title']));
    }

    public function create(){
        $title="Tambah Anggota";
        $fakultas=Fakultas::all();
        return view('anggota.create',compact("title","fakultas"));
    }

    public function store(Request $request)
    {
        $cek=Anggota::where('kedudukan','ketua')->first();
        if ($request->kedudukan == 'ketua') {
            
            if($cek !=   null){
            Alert::error("Error", "Ketua sudah ada");
            return redirect('/anggota/create');
            }
        }
        // Validasi data yang diterima dari form
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:255', // Nama harus diisi, berupa string, maksimal 255 karakter
            'Nim' => 'required|string|max:20|unique:anggota,nim', // Nim harus unik dalam tabel anggotas
            'fakultas_id' => 'required|exists:fakultas,id', // ID fakultas harus ada dalam tabel fakultas
            'id_jurusan' => 'required|exists:jurusans,id', // ID jurusan harus ada dalam tabel jurusan
            'jenis_kelamin' => 'required|in:L,P', // Jenis kelamin harus L atau P
            'kedudukan' => 'required|string|in:ketua,wakil,bendahara,sekretaris,anggota', // Kedudukan harus salah satu dari nilai yang ditentukan
            'email' => 'required|unique:users,email', // Email harus unik dalam tabel anggotas
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            $messages = $validator->errors()->all(); // Mengumpulkan semua pesan error
            Alert::error('Error', implode('<br>', $messages))->flash(); // Tampilkan pesan error menggunakan SweetAlert
            return back()->withErrors($validator)->withInput(); // Kembali ke form dengan pesan error dan input sebelumnya
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Buat entitas User baru
            $user = new User();
            $user->name = $request->Nama; // Set nama dari input form
            $user->role = $request->kedudukan; // Set peran (role) dari input form
            $user->email = $request->email; // Set email dari input form
            $user->username = $request->Nim; // Set username dari input form
            $user->password = bcrypt($request->Nim); // Hash password menggunakan bcrypt dengan Nim sebagai password
            $user->save(); // Simpan data User ke database

            // Buat entitas Anggota baru
            $anggota = new Anggota();
            $anggota->nama = $request->Nama; // Set nama anggota dari input form
            $anggota->nim = $request->Nim; // Set Nim anggota dari input form
            $anggota->id_jurusan = $request->id_jurusan; // Set ID jurusan dari input form
            $anggota->kedudukan = $request->kedudukan; // Set kedudukan dari input form
            $anggota->jenis_kelamin = $request->jenis_kelamin; // Set jenis kelamin dari input form
            $anggota->id_user = $user->id; // Set ID User yang baru saja dibuat
            $anggota->save(); // Simpan data Anggota ke database

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            // Tampilkan pesan sukses menggunakan SweetAlert
            Alert::success('Sukses', 'Anggota berhasil ditambahkan')->flash();

            // Redirect ke halaman daftar anggota
            return redirect()->route('anggota');

        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Tampilkan pesan error dengan informasi kesalahan
            Alert::error('Gagal', 'Terjadi kesalahan saat menambahkan anggota: ' . $th->getMessage())->flash();
            return back()->withInput(); // Kembali ke form dengan input sebelumnya
        }
    }

    public function edit($id){
        $title="Edit Anggota";
        $data = Anggota::with('jurusan.fakultas','user')->find($id);
        $fakultas = Fakultas::all();
        return view('anggota.edit', compact(['data', 'fakultas', 'title']));
    }

    public function update($id, Request $request){
        $cek=Anggota::where('kedudukan','ketua')->first();
        if ($request->kedudukan == 'ketua') {
            
            if($cek !=   null){
            Alert::error("Error", "Ketua sudah ada");
            return back();
            }
        }
        $validator = Validator::make($request->all(), [
            'fakultas_id' => 'required|integer|exists:fakultas,id',
            'id_jurusan' => 'required|integer|exists:jurusans,id',
            'Nim' => 'required|string|max:20|unique:anggota,nim,'.$id, // Nim harus unik dalam tabel anggotas
            'email' => 'required|unique:users,email,'.$id,
             // Email harus unik dalam tabel anggotas
            'kedudukan' => 'required|string|in:ketua,wakil,bendahara,sekretaris,anggota',// Kedudukan harus salah satu dari nilai yang ditentukan
            'Nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:L,P',
            
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages)->flash();
            return back()->withErrors($validator)->withInput();
        }

        $anggota = Anggota::find($id);
$user = User::find($anggota->id_user);
$user->email=$request->email;
$user->name=$request->Nama;
$user->role=$request->kedudukan;
$user->username=$request->Nim;
$user->password=bcrypt($request->Nim);
$user->save();

$anggota->Nama=$request->Nama;
$anggota->Nim=$request->Nim;
$anggota->id_jurusan=$request->id_jurusan;
$anggota->kedudukan=$request->kedudukan;
$anggota->jenis_kelamin=$request->jenis_kelamin;
$anggota->save();
Alert::success("Succes","Berhasil Ubah Data anggota");
return redirect()->route('anggota');
        // $anggota->update($request->except(['_token','submit']));
        // return redirect('/anggota');



        // $anggota = Anggota::find($id);


        // $anggota->update($request->except(['_token','submit']));
        // return redirect('/anggota');
    }

    public function destroy($id){
        $anggota = Anggota::find($id);
        
        $anggota->delete();
        $user=User::find($anggota->id_user);
        $user->delete();
        Alert::success("Succes","Berhasil Hapus Data anggota");
        return redirect('/anggota');
    }
}
