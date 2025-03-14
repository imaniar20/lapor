@extends('layout.master')
@section('Content')

<div class="card mb-4 order-0">
  <h5 class="card-header">Table Pengaduan</h5>
  <div class="card-body">
    <div class="table-responsive p-2">
        <table class="table table-striped datatable display nowrap">
      <thead>
        <tr>
          <th>No</th>
          <th>No Laporan</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>No Telp</th>
          <th>Kategori</th>
          <th>Laporan</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @php
            $i = 1;
        @endphp
        @foreach ($laporan as $data)
          <tr>
            <th>{{ $i++ }}</th>
            <th>{{ $data['nomor_laporan'] }}</th>
            <td>+{{ $data['nomor_pelapor'] }}</td>
            <th>{{ $data['nik'] }}</th>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $data['nama'] }}</strong></td>
            <td>{{ $data['kategori'] }}</td>
            <td>{{ $data['judul'] }}</td>
            <td>
              @if ($data['status'] == "Proses")
                <span class="badge bg-label-info me-1">Proses</span>
              @elseif($data['status'] == "Selesai")
                <span class="badge bg-label-success me-1">Selesai</span>
              @elseif($data['status'] == "Menunggu")
                <span class="badge bg-label-warning me-1">Menunggu</span>
              @elseif($data['status'] == "Tidak Valid")
                <span class="badge bg-label-danger me-1">Tidak Valid</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item open-edit" data-bs-toggle="modal" data-bs-target="#edit"
                        data-id="{{ $data['id'] }}" 
                        data-nomor_pelapor="{{ $data['nomor_pelapor'] }}" 
                        data-nomor_laporan="{{ $data['nomor_laporan'] }}" 
                        data-kategori="{{ $data['kategori'] }}" 
                        data-nama="{{ $data['nama'] }}" 
                        data-alamat="{{ $data['alamat'] }}" 
                        data-nik="{{ $data['nik'] }}" 
                        data-judul="{{ $data['judul'] }}" 
                        data-isi="{{ $data['isi'] }}" 
                        data-gambar="{{ $data['gambar_path'] }}" 
                        data-tanggal="{{ $data['tanggal'] }}"
                        data-keterangan="{{ $data['keterangan'] }}"
                        data-status="{{ $data['status'] }}"
                        data-keterangan="{{ $data['keterangan'] }}"

                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                  >
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>

<div class="modal fade" id="edit" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
      <form class="modal-content" method="POST" action="{{ route('pengaduan.update', 1) }}" id="edit" enctype="multipart/form-data">
      @csrf
      @method('PUT')
          <div class="modal-header">
              <h5 class="modal-title" id="backDropModalTitle">Data Laporan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <input type="hidden" name="id" id="id">
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-lg-6 col-sm-12 mb-3">
                      <label for="nomor_pelapor" class="form-label">Nomor Pelapor</label>
                      <input id="nomor_pelapor" name="nomor_pelapor" class="form-control" disabled>
                  </div>
                  <div class="col-lg-6 col-sm-12 mb-3">
                      <label for="nomor_laporan" class="form-label">Nomor Laporan</label>
                      <input id="nomor_laporan" name="nomor_laporan" class="form-control" disabled>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-6 col-sm-12 mb-3">
                      <label for="nik" class="form-label">NIK</label>
                      <input id="nik" name="nik" class="form-control" disabled>
                  </div>
                  <div class="col-lg-6 col-sm-12 mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input id="nama" name="nama" class="form-control" disabled>
                  </div>
              </div>
              <div class="row">
                  <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat</label>
                      <textarea  id="alamat" name="alamat" class="form-control" disabled></textarea >
                  </div>
              </div>
              <div class="row">
                  <div class="mb-3">
                      <label for="judul" class="form-label">Judul Pengaduan</label>
                      <input id="judul" name="judul" class="form-control" disabled>
                  </div>
              </div>
              <div class="row">
                  <div class="mb-3">
                      <label for="isi" class="form-label">Isi Pengaduan</label>
                      <textarea  id="isi" name="isi" class="form-control" disabled></textarea >
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-6 col-sm-12 mb-3">
                      <label for="tanggal" class="form-label">Tanggal</label>
                      <input type="text" id="tanggal" name="tanggal" class="form-control" disabled>
                  </div>
                  <div class="col-lg-6 col-sm-12 mb-3">
                      <label for="gambar" class="form-label">Bukti Dukung</label>
                      <a href="{{ asset('assets/img/logo/kuningan.png')}}" target="_blank"><img id="gambar" name="gambar" class="form-control" src="{{ asset('assets/img/logo/kuningan.png')}}" style="width: 200px" alt=""></a>
                  </div>
              </div>
              <div class="row">
                  <div class="mb-3">
                      <label for="status" class="form-label">Status</label>
                      <select name="status" id="status" class="form-control" required>
                          <option value="Proses">Proses</option>
                          <option value="Selesai">Selesai</option>
                          <option value="Menunggu">Menunggu</option>
                          <option value="Tidak Valid">Tidak Valid</option>
                      </select>
                  </div>
              </div>
              <div class="row">
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea  id="keterangan" name="keterangan" class="form-control" required></textarea >
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <a class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Batal
              </a>
              <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
      </form>
  </div>
</div>

<script>
  $(".open-edit").on("click", function () {
        var id = $(this).data('id');
        var nomor_pelapor = $(this).data('nomor_pelapor');
        var nomor_laporan = $(this).data('nomor_laporan');
        var nik = $(this).data('nik');
        var nama = $(this).data('nama');
        var alamat = $(this).data('alamat');
        var judul = $(this).data('judul');
        var isi = $(this).data('isi');
        var tanggal = $(this).data('tanggal');
        var gambar = $(this).data('gambar');
        var status = $(this).data('status');
        var keterangan = $(this).data('keterangan');
        // console.log(alamat);
        $(".modal-header #id").val(id);
        $(".modal-body #nomor_pelapor").val(nomor_pelapor);
        $(".modal-body #nomor_laporan").val(nomor_laporan);
        $(".modal-body #nik").val(nik);
        $(".modal-body #nama").val(nama);
        $(".modal-body #alamat").val(alamat);
        $(".modal-body #judul").val(judul);
        $(".modal-body #isi").val(isi);
        $(".modal-body #tanggal").val(tanggal);
        $(".modal-body #gambar").val(gambar);
        $(".modal-body #status").val(status);
        $(".modal-body #keterangan").val(keterangan);
  });
</script>
@endsection