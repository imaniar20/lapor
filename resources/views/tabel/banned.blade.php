@extends('layout.master')
@section('Content')

<div class="card mb-4 order-0">
  <h5 class="card-header">Table Banned User</h5>
  <div class="card-body">
    <a class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#tambah"><i class='bx bx-plus-circle'></i> Tambah</a>
    <div class="table-responsive p-2">
        <table class="table table-striped datatable display nowrap">
            <thead>
                <tr>
                <th>No</th>
                <th>Nomor User</th>
                <th>Waktu Mulai</th>
                <th>Waktu Berakhir</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                
                @forelse ($banned as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data['nomor_user'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($data['waktu_mulai'])->format('d M Y H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data['waktu_berakhir'])->format('d M Y H:i:s') }}</td>
                    <td>{{ $data['alasan'] }}</td>
                    <td>
                        @if ($data['is_permanent'] == 1)
                            <span class="badge bg-label-danger me-1">Permanent</span>
                        @else
                            <span class="badge bg-label-warning me-1">Temporary</span>
                        @endif
                    </td>
                    <td>
                        {{-- <a href="#" class="open-Hapus" data-id="{{ $data['nomor_user'] }}"><i class="bx bx-trash me-1 text-danger"></i></a> --}}
                        <form action="{{ route('banned_user.destroy', $data['nomor_user']) }}" method="POST" style="display:inline;">
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
        <form class="modal-content" method="POST" action="{{ route('banned_user.store') }}" id="tambah" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Bannde User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-body">
                <label for="nomor_user" class="form-label">Nomor User</label>
                <input type="text" name="nomor_user" id="nomor_user" class="form-control mb-3" required>

                <label for="alasan" class="form-label">Alasan</label>
                <textarea name="alasan" id="alasan" class="form-control mb-3" required></textarea>

                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>

<script>
    
</script>
@endsection