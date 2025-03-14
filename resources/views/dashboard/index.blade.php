@extends('layout.master')
@section('Content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-sm-12 col-md-12 mb-4">
            <div class="card mb-4 order-0">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Data Pengaduan Kabupaten Kuningan 🎉</h5>
                        <p class="mb-4">
                        Pengaduan hari ini <span class="fw-bold">{{ count($laporan) }}</span>
                        </p>
    
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">Lihat Tabel Pengaduan</a>
                    </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img
                        src="../assets/img/illustrations/man-with-laptop-light.png"
                        height="140"
                        alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                    </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 order-0">
                <div class="row row-bordered g-0">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Total Pengaduan</h5>
                        <div id="totalRevenueChart" class="px-2" ></div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                            <div class="dropdown">
                                <button
                                class="btn btn-sm btn-outline-primary"
                                type="button"
                                id="growthReportId"
                                >
                                2025
                                </button>
                            </div>
                            </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">Perbandingan Dengan Bulan Sebelumnya</div>
    
                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-primary p-2"><i class='bx bx-book-content'></i></span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>Februari</small>
                                <h6 class="mb-0">7 Pengaduan</h6>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-info p-2"><i class='bx bx-book-content'></i></span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>Maret</small>
                                <h6 class="mb-0">15 Pengaduan</h6>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 order-0">
                <h5 class="card-header">Table Pengaduan</h5>
                <div class="card-body">
                    <div class="table-responsive p-2">
                        <table class="table table-striped datatable display nowrap">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Penaduan</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($laporan as $data)
                                    <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $data->nama }}</strong></td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->pengaduan }}</td>
                                    <td>
                                        @if ($data->validasi == "Proses")
                                        <span class="badge bg-label-info me-1">Proses</span>
                                        @elseif($data->validasi == "Selesai")
                                        <span class="badge bg-label-success me-1">Selesai</span>
                                        @elseif($data->validasi == "Tertunda")
                                        <span class="badge bg-label-warning me-1">Tertunda</span>
                                        @elseif($data->validasi == "Tidak Valid")
                                        <span class="badge bg-label-danger me-1">Tidak Valid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"
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
        </div>

        <div class="col-lg-4 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img
                            src="../assets/img/icons/unicons/chart.png"
                            alt="chart success"
                            class="rounded"
                            />
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt3"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pengaduan 1</span>
                        <h3 class="card-title mb-2">2 Pengaduan</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0</small>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img
                            src="../assets/img/icons/unicons/cc-success.png"
                            alt="Credit Card"
                            class="rounded"
                            />
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt6"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                        </div>
                        <span>Pengaduan 2</span>
                        <h3 class="card-title text-nowrap mb-1">4 Pengaduan</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +3</small>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/cc-warning.png" alt="Credit Card" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt4"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                        </div>
                        <span class="d-block mb-1">Pengaduan 3</span>
                        <h3 class="card-title text-nowrap mb-2">1 Pengaduan</h3>
                        <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -1</small>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt1"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pengaduan 4</span>
                        <h3 class="card-title mb-2">3 Pengaduan</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +3</small>
                    </div>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Statistik Pengaduan</h5>
                            <small class="text-muted">Total 40 Laporan Pengaduan Sejak 2025</small>
                            </div>
                            <div class="dropdown">
                            <button
                                class="btn p-0"
                                type="button"
                                id="orederStatistics"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h4 class="mb-2">Tahun 2025 = 40 </h4>
                                <span>Laporan Pengaduan</span>
                            </div>
                            <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary"
                                    ><i class='bx bx-book-content' ></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Pengaduan 1</h6>
                                    <small class="text-muted">Tentang Pengaduan 1</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">10 Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i class='bx bx-book-content' ></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Pengaduan 2</h6>
                                    <small class="text-muted">Tentang Pengaduan 2</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">15 Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class='bx bx-book-content' ></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Pengaduan 3</h6>
                                    <small class="text-muted">Tentang Laporan Pengaduan 3</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">5 Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-secondary"
                                    ><i class='bx bx-book-content' ></i
                                ></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Pengaduan 4</h6>
                                    <small class="text-muted">Tentang Pengaduan 4</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">10 Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection