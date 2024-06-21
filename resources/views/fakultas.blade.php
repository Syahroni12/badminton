@extends('templating.main')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            tambah data
          </button>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>fakultas</th>
                 
                    <th>aksi</th>
                </tr>
            </thead>
           
            <tbody>
                @php
                 $i=1;   
                @endphp
                @foreach ($fakultas as $item)
                    
               
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->nama_fakultas }}</td>
                    <td><button class="btn btn-danger" onclick="hapus({{ $item->id }})">hapus</button>|<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $item }})">
                        edit data
                      </button></td>
                 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('tambah_fakultas') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="fakultas" class="form-label">Fakultas</label>
                <input type="text" class="form-control" id="fakultas" name="nama_fakultas">
              </div>
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('update_fakultas') }}" method="post">

      @csrf
      <div class="mb-3">
      <label for="fakultass" class="form-label">Fakultas</label>
      <input type="text" class="form-control" id="fakultass" name="nama_fakultas">
    </div>
    <input type="hidden" name="id" id="idd">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function edit(data) { 
        document.getElementById("idd").value = data.id;
        document.getElementById("fakultass").value = data.nama_fakultas;
     }
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
                    window.location.href = `/hapus_fakultas/${id}`;
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