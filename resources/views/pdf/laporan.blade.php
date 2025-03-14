<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 5px;  }
        th { background-color: #f2f2f2; text-align: center;}
        td { text-align: left; }
        /* Jika tabel masih terlalu lebar, tambahkan overflow */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">{{ $title }}</h2>
    <table style="width: 40%; border: 0px solid rgb(255, 255, 255);">
        <tbody>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $start }} sampai {{ $end }}</td>
            </tr>
            <tr>
                <td>Proses</td>
                <td>: {{ $summary['Proses'] }} Laporan</td>
            </tr>
            <tr>
                <td>Menunggu</td>
                <td>: {{ $summary['Menunggu'] }} Laporan</td>
            </tr>
            <tr>
                <td>Tidak Valid</td>
                <td>: {{ $summary['Tidak Valid'] }} Laporan</td>
            </tr>
            <tr>
                <td>Selesai</td>
                <td>: {{ $summary['Selesai'] }} Laporan</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">No Laporan</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">NIK</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">No Telp</th>
                <th rowspan="2">Alamat</th>
                <th rowspan="2">Kategori</th>
                <th colspan="2">Laporan</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">keterangan</th>
            </tr>
            <tr>
                <th>Judul</th>
                <th>isi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
        @endphp
        @foreach ($export as $data)
            <tr>
                <th>{{ $i++ }}</th>
                <td>{{ $data['nomor_laporan'] }}</td>
                <td>{{ \Carbon\Carbon::parse($data['tanggal'])->format('d M Y') }}</td>
                <td>{{ $data['nik'] }}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $data['nama'] }}</strong></td>
                <td>+{{ $data['nomor_pelapor'] }}</td>
                <td>{{ $data['alamat'] }}</td>
                <td>{{ $data['kategori'] }}</td>
                <td>{{ $data['judul'] }}</td>
                <td>{{ $data['isi'] }}</td>
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
                <td>{{ $data['keterangan'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
