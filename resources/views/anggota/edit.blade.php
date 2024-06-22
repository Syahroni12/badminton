@extends('templating.main')
@section('content')
    <div class="card mb-4">
        <div class="card-body">

            <form action="{{ route('anggota.update', $data->id) }}" method="post">
                @method('put')
                @csrf

                <label for="Nama-Anggota" class="form-label">Nama Anggota</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" id="Nama-Anggota" name="Nama" value="{{ $data->Nama }}">
                </div>
                <label for="Nim" class="form-label">Nim Anggota</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" id="Nim" name="Nim" value="{{ $data->Nim }}">
                </div>
                <label for="fakultas" class="form-label">Fakultas</label>

                <div class="input-group mb-3">

                    <select class="form-select" aria-label="Default select example" id="fakultas" name="fakultas_id">

                        @foreach ($fakultas as $item)
                            <option value="{{ $item->id }}"    @selected($item->id == $data->jurusan->fakultas->id)>
                                {{ $item->nama_fakultas }}</option>
                        @endforeach

                    </select>
                </div>
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" id="id_jurusan" name="id_jurusan">
                       


                        <option value="{{ $data->id_jurusan }}">{{ $data->jurusan->nama_jurusan }}</option>


                    </select>
                </div>
                <label for="jenis_kel" class="form-label">Jenis Kelamin</label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" id="jenis_kel" name="jenis_kelamin">
                        <option selected> Jenis Kelamin</option>


                        <option value="L"   @selected($data->jenis_kelamin == 'L')>L</option>
                        <option value="P"   @selected($data->jenis_kelamin == 'P')>P</option>


                    </select>
                </div>
                <label for="kedudukan" class="form-label">Kedudukan</label>
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" id="keduduka" name="kedudukan">
                        <option selected>Pilih kedudukan</option>


                        <option value="ketua" @selected($data->kedudukan == 'ketua')>ketua</option>
                        <option value="wakil" @selected($data->kedudukan == 'wakil')>wakil</option>
                        <option value="bendahara" @selected($data->kedudukan == 'bendahara')>bendahara</option>
                        <option value="sekretaris" @selected($data->kedudukan == 'sekretaris')>sekretaris</option>
                        <option value="anggota" @selected($data->kedudukan == 'anggota')>anggota</option>


                    </select>
                </div>
                <label for="email" class="form-label">email Anggota</label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" id="email" name="email" value="{{ $data->user->email}}">
                </div>






                <button class="btn btn-primary" type="submit">simpan</button>
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
                                    $('#id_jurusan').append('<option value="' + jurusan
                                        .id + '">' + jurusan.nama_jurusan +
                                        '</option>');
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
