<h1>Edit Anggota</h1>

<form action="/anggota/{{$anggota->id}}" method="post">
    @method('put')
    @csrf
    <input type="text" name="Nama" placeholder="Nama" value="{{$anggota->Nama}}"><br>
    <input type="text" name="Nim" placeholder="Nim" value="{{$anggota->Nim}}"><br>
    <input type="text" name="Fakultas" placeholder="Fakultas" value="{{$anggota->Fakultas}}"><br>
    <input type="text" name="Jurusan" placeholder="Jurusan" value="{{$anggota->Jurusan}}"><br>
    <input type="text" name="Angkatan" placeholder="Angkatan" value="{{$anggota->Angkatan}}"><br>
    <select name="jenis_kelamin" id="">
        <option value="">Pilih Jenis Kelamin</option>
        <option value="L" @if($anggota->jenis_kelamin == "L")selected @endif>Laki-Laki</option>
        <option value="P" @if($anggota->jenis_kelamin == "P")selected @endif>Perempuan</option>
    </select><br>
    <input type="submit" name="submit" value="Save">

</form>