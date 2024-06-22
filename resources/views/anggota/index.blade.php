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
    <div class="container">
        <a class="btn btn-info" href="/anggota/create">Add Anggota</a>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Angkatan</th>
                <th>jenis_kelamin</th>
                <th>AKSI</th>
            </tr>

            @foreach($anggota as $a)
            <tr>
                <td>{{$a->id}}</td>
                <td>{{$a->Nama}}</td>
                <td>{{$a->Nim}}</td>
                <td>{{$a->Fakultas}}</td>
                <td>{{$a->Jurusan}}</td>
                <td>{{$a->Angkatan}}</td>
                <td>{{$a->jenis_kelamin}}</td>
                <td>
                    <a href="/anggota/{{$a->id}}/edit">Edit</a>
                    <form action="/anggota/{{$a->id}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </table> 
    </div>
   
</body>
</html>
 --}}



 @extends('templating.main')
@section('content')
<div class="card mb-4">
    <div class="card-body">
       <a href="{{ route('tambah_anggota') }}" class="btn btn-primary">Tambah Anggota</a>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nim</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>jenis_kelamin</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                 
                    <th>aksi</th>
                </tr>
            </thead>
           
            <tbody>
                @php
                 $i=1;   
                @endphp
                @foreach ($anggota as $item)
                    
               
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->Nama }}</td>
                    <td>{{ $item->Nim }}</td>
                    <td>{{ $item->jurusan->fakultas->nama_fakultas }}</td>
                    <td>{{ $item->jurusan->nama_jurusan }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->kedudukan }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td><button class="btn btn-danger" onclick="hapus({{ $item->id }})">hapus</button>|<a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-warning">Edit</a></td>
                 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
        function hapus(id) {
            Swal.fire({
                title: "Apakah Kamu Yakin?",
                text: "Apakah Kamu Yakin Ingin Menghapus Data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log(id);
                    window.location.href = `/hapus_anggota/${id}`;
                    // window.location.href = "/selesaikan/".itemId "";
                    // Swal.fire({
                    //     title: "Deleted!",
                    //     text: "Your file has been deleted.",
                    //     icon: "success"
                    // });
                }
            });
        }
</script>
@endsection
