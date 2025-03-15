@extends('layout.master')
@section('Content')
    <div class="row">
        <div class="col-lg-8 col-sm-12 col-md-12 mb-4">
            <div class="card mb-4 order-0">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Data Pengaduan Kabupaten Kuningan 🎉</h5>
                        <p class="mb-4">
                        Pengaduan hari ini <span class="fw-bold">{{ $laporanHariIni }}</span>
                        </p>
    
                        <a href="/pengaduan" class="btn btn-sm btn-outline-primary">Lihat Tabel Pengaduan</a>
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
                        <h5 class="card-header m-0 me-2 pb-3">Total Pengaduan {{date('Y')}}</h5>
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
                                <h6 class="mb-0">{{ $jumlahBulanLalu }} Pengaduan</h6>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-info p-2"><i class='bx bx-book-content'></i></span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>Maret</small>
                                <h6 class="mb-0">{{ $jumlahBulanIni }} Pengaduan</h6>
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
                                {{-- <th>#</th> --}}
                                <th>Nomor Laporan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Pengaduan</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($laporan as $data)
                                    <tr>
                                        {{-- <td>{{ $i++ }}</td> --}}
                                        <td>{{ $data['nomor_laporan'] }}</td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $data['nama'] }}</strong></td>
                                        <td>{{ $data['alamat'] }}</td>
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
                            <i class='bx bx-hourglass loading' style="color: orange; font-size: 40px"></i>
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
                        <span class="fw-semibold d-block mb-1">Menunggu</span>
                        <h3 class="card-title text-nowrap mb-2">{{ $status['Menunggu'] }} Pengaduan</h3>
                        <small class="text-warning fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ $statusThisMonth['Menunggu'] }} Bulan Ini</small>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-refresh bx-spin' style="color: aqua; font-size: 40px"></i>
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
                        <span class="fw-semibold d-block mb-1">Porses</span>
                        <h3 class="card-title mb-2">{{ $status['Proses'] }} Pengaduan</h3>
                        <small class="text-info fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ $statusThisMonth['Proses'] }} Bulan Ini</small>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-check-circle done' style="color: rgb(0, 255, 102); font-size: 40px"></i>
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
                            </div>
                        </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Selesai</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $status['Selesai'] }} Pengaduan</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ $statusThisMonth['Selesai'] }} Bulan Ini</small>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-info-circle warning' style="color: red; font-size: 40px"></i>
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
                        <span class="fw-semibold d-block mb-1">Tidak Valid</span>
                        <h3 class="card-title mb-1">{{ $status['Tidak Valid'] }} Pengaduan</h3>
                        <small class="text-danger fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ $statusThisMonth['Tidak Valid'] }} Bulan Ini</small>
                    </div>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Statistik Pengaduan</h5>
                            <small class="text-muted">Total {{ count($laporan) }} Laporan Pengaduan Sampai {{ date('Y') }}</small>
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
                                <h4 class="mb-2">Tahun {{ date('Y') }} = {{ count($laporan) }} </h4>
                                <span>Laporan Pengaduan</span>
                            </div>
                            <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-secondary"
                                    ><i class='bx bx-building-house' ></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Infrastruktur</h6>
                                    <small class="text-muted">Keluhan terkait jalan rusak, jembatan ambruk, drainase buruk, bangunan umum yang rusak, atau proyek pembangunan yang mangkrak.</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold text-secondary">{{ $kategori['Infrastruktur'] }} Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class='bx bx-book'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Pendidikan</h6>
                                    <small class="text-muted">Masalah di sekolah, seperti kekurangan guru, fasilitas sekolah yang tidak memadai, pungutan liar, atau akses pendidikan yang sulit.</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold text-info">{{ $kategori['Pendidikan'] }} Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"><i class='bx bx-plus-medical'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Kesehatan</h6>
                                    <small class="text-muted">Keluhan tentang layanan rumah sakit, puskesmas, kurangnya tenaga medis, mahalnya biaya pengobatan, atau masalah dengan BPJS Kesehatan.</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold text-danger">{{ $kategori['Kesehatan'] }} Pengaduan</small>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"
                                    ><i class='bx bx-bulb'></i></i
                                ></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Penerangan Jalan Umum</h6>
                                    <small class="text-muted">Laporan tentang lampu jalan yang mati, minimnya penerangan di daerah tertentu, atau lampu yang menyala terus di siang hari.</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold text-warning">{{ $kategori['Penerangan Jalan Umum'] }} Pengaduan</small>
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

    <script>
        (function () {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;

            const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
            totalRevenueChartOptions = {
                series: [
                    {
                        name: '2025',
                        data: [
                            <?php
                                foreach($totalPengaduan as $data => $value){
                                    echo $value . ',';
                                }
                            ?>
                        ]
                    }
                ],
                chart: {
                    height: 300,
                    stacked: true,
                    type: 'bar',
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '33%',
                        borderRadius: 12,
                        startingShape: 'rounded',
                        endingShape: 'rounded'
                    }
                },
                colors: [config.colors.primary, config.colors.info],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 6,
                    lineCap: 'round',
                    colors: [cardColor]
                },
                legend: {
                    show: true,
                    horizontalAlign: 'left',
                    position: 'top',
                    markers: {
                        height: 8,
                        width: 8,
                        radius: 12,
                        offsetX: -3
                    },
                    labels: {
                        colors: axisColor
                    },
                    itemMargin: {
                        horizontal: 10
                    }
                },
                grid: {
                    borderColor: borderColor,
                    padding: {
                        top: 0,
                        bottom: -8,
                        left: 20,
                        right: 20
                    }
                },
                xaxis: {
                    categories: [
                        <?php
                            foreach($totalPengaduan as $data => $value){
                                echo "'" . $data . "',";
                            }
                        ?>
                    ],
                    labels: {
                    style: {
                        fontSize: '13px',
                        colors: axisColor
                    }
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: axisColor
                        }
                    }
                },
                responsive: [{
                        breakpoint: 1700,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '32%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1580,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '35%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1440,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '42%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1300,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '48%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '40%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1040,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 11,
                                    columnWidth: '48%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 991,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '30%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 840,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '35%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 768,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '28%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 640,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '32%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 576,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '37%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 480,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '45%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 420,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '52%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 380,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '60%'
                                }
                            }
                        }
                    }
                ],
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };
            if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
                const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                totalRevenueChart.render();
            }

            const growthChartEl = document.querySelector('#growthChart'),
            growthChartOptions = {
                series: [{{$persentase}}],
                labels: ['Perbandingan'],
                chart: {
                    height: 240,
                    type: 'radialBar'
                },
                plotOptions: {
                    radialBar: {
                        size: 150,
                        offsetY: 10,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            size: '55%'
                        },
                        track: {
                            background: cardColor,
                            strokeWidth: '100%'
                        },
                        dataLabels: {
                            name: {
                                offsetY: 15,
                                color: headingColor,
                                fontSize: '15px',
                                fontWeight: '600',
                                fontFamily: 'Public Sans'
                            },
                            value: {
                                offsetY: -25,
                                color: headingColor,
                                fontSize: '22px',
                                fontWeight: '500',
                                fontFamily: 'Public Sans'
                            }
                        }
                    }
                },
                colors: [config.colors.primary],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        shadeIntensity: 0.5,
                        gradientToColors: [config.colors.primary],
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 0.6,
                        stops: [30, 70, 100]
                    }
                },
                stroke: {
                    dashArray: 5
                },
                grid: {
                    padding: {
                        top: -35,
                        bottom: -10
                    }
                },
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };
            if (typeof growthChartEl !== undefined && growthChartEl !== null) {
                const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
                growthChart.render();
            }

            const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
            orderChartConfig = {
            chart: {
                height: 165,
                width: 130,
                type: 'donut'
            },
            labels: [
                <?php
                    foreach($kategoriThisMonth as $data => $value){
                        echo "'" . $data . "',";
                    }
                ?>
            ],
            series: [
                <?php
                    foreach($kategoriThisMonth as $data => $value){
                        echo $value . ",";
                    }
                ?>
            ],
            colors: [config.colors.secondary, config.colors.info, config.colors.danger, config.colors.warning],
            stroke: {
                width: 5,
                colors: cardColor
            },
            dataLabels: {
                enabled: false,
                formatter: function (val, opt) {
                return parseInt(val);
                }
            },
            legend: {
                show: false
            },
            grid: {
                padding: {
                top: 0,
                bottom: 0,
                right: 15
                }
            },
            plotOptions: {
                pie: {
                donut: {
                    size: '75%',
                    labels: {
                    show: true,
                    value: {
                        fontSize: '1.5rem',
                        fontFamily: 'Public Sans',
                        color: headingColor,
                        offsetY: -15,
                        formatter: function (val) {
                        return parseInt(val);
                        }
                    },
                    name: {
                        offsetY: 20,
                        fontFamily: 'Public Sans'
                    },
                    total: {
                        show: true,
                        fontSize: '0.8125rem',
                        color: axisColor,
                        label: '{{ date('M-Y') }}',
                        formatter: function (w) {
                        return {{ $jumlahBulanIni }};
                        }
                    }
                    }
                }
                }
            }
            };
            if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
                const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
                statisticsChart.render();
            }
        })();
    </script>
@endsection