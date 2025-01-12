<!DOCTYPE html>
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

