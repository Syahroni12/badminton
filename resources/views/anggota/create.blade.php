{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h1>Masukan Data Anggota</h1>

    <form action="/anggota/store" method="post">
        @csrf
        <input type="text" name="Nama" placeholder="Nama"><br>
        <input type="text" name="Nim" placeholder="Nim"><br>
        <input type="text" name="Fakultas" placeholder="Fakultas"><br>
        <input type="text" name="Jurusan" placeholder="Jurusan"><br>
        <input type="text" name="Angkatan" placeholder="Angkatan"><br>
        <select name="jenis_kelamin" id="">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select><br>
        <input type="submit" name="submit" value="Save">

    </form>
</body>
</html> --}}

@extends('templating.main')
@section('content')
    <div class="card mb-4">
        <div class="card-body">

            <form action="{{ route('anggota.store') }}" method="post">
                @csrf

                <label for="Nama-Anggota" class="form-label">Nama Anggota</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" id="Nama-Anggota" name="Nama" value="{{ old('Nama') }}">
                </div>
                <label for="Nim" class="form-label">Nim Anggota</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" id="Nim" name="Nim" value="{{ old('Nim') }}">
                </div>
                <label for="fakultas" class="form-label">Fakultas</label>
               
                <div class="input-group mb-3">
              
                <select class="form-select" aria-label="Default select example" id="fakultas" name="fakultas_id" >
                  <option selected>Pilih Fakultas</option>
                  @foreach ($fakultas as $item)
                      
                  <option value="{{ $item->id }}">{{ $item->nama_fakultas }}</option>
                  @endforeach
               
                </select>
                </div>
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <div class="input-group mb-3">
                <select class="form-select" aria-label="Default select example" id="id_jurusan" name="id_jurusan" >
                  <option selected>Pilih jurusan</option>
                
                      
                  <option value=""></option>
                 
               
                </select>
                </div>
                <label for="jenis_kel" class="form-label">Jenis Kelamin</label>
                <div class="input-group mb-3">
                <select class="form-select" aria-label="Default select example" id="jenis_kel" name="jenis_kelamin" >
                  <option selected> Jenis Kelamin</option>
                
                      
                  <option value="L">L</option>
                  <option value="P">P</option>
                 
               
                </select>
                </div>
                <label for="kedudukan" class="form-label">Kedudukan</label>
                <div class="input-group mb-3">
                <select class="form-select" aria-label="Default select example" id="keduduka" name="kedudukan" >
                  <option selected>Pilih kedudukan</option>
                
                      
                  <option value="ketua">ketua</option>
                  <option value="wakil">wakil</option>
                  <option value="bendahara">bendahara</option>
                  <option value="sekretaris">sekretaris</option>
                  <option value="anggota">anggota</option>
                 
               
                </select>
                </div>
                <label for="email" class="form-label">email Anggota</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>





                
                <button class="btn btn-primary" type="submit">Tambah</button>
                <a href="{{ route('anggota') }}" class="btn btn-danger">Batal</a>

            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener untuk perubahan pilihan fakultas
            $('#fakultas').on('change', function() {
                var fakultas_id = $(this).val();

                // Bersihkan pilihan jurusan saat fakultas berubah
                $('#id_jurusan').html('<option selected>Pilih Jurusan</option>');

                // Jika fakultas dipilih, lakukan AJAX request untuk mendapatkan jurusan
                if (fakultas_id) {
                    $.ajax({
                        url: '/jurusan/' + fakultas_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                // Tambahkan pilihan jurusan yang diterima dari server
                                $.each(data, function(key, jurusan) {
                                    $('#id_jurusan').append('<option value="' + jurusan.id + '">' + jurusan.nama_jurusan + '</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
