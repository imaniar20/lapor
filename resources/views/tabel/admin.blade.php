@extends('layout.master')
@section('Content')

<div class="card mb-4 order-0">
  <h5 class="card-header">Table Admin</h5>
  <div class="card-body">
    <a class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#tambah"><i class='bx bx-plus-circle'></i> Tambah</a>
    <div class="table-responsive p-2">
        <table class="table table-striped datatable display nowrap">
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor Admin</th>
          <th>Nama</th>
          <th>Level</th>
          <th>Tanggal Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @php
            $i = 1;
        @endphp
        
        @forelse ($admin as $data)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $data['nomor_admin'] }}</td>
            <td>{{ $data['nama'] }}</td>
            <td>{{ $data['level'] }}</td>
            <td>{{ \Carbon\Carbon::parse($data['tanggal_dibuat'])->format('d M Y H:i:s') }}</td>
            <td>
                <form action="{{ route('admin_user.destroy', $data['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="confirmDelete(event)" class="btn btn-danger btn-sm">Hapus</button>
               </form>
            </td>
          </tr>
        @empty
        @endforelse
      </tbody>
    </table>
  </div>
  </div>
</div>

<div class="modal fade" id="tambah" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('admin_user.store') }}" id="tambah" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-body">
                <label for="nomor_admin" class="form-label">Nomor Admin</label>
                <input type="text" name="nomor_admin" id="nomor_admin" class="form-control mb-3" required>

                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control mb-3" required>

                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>

<script>
    
</script>
@endsection