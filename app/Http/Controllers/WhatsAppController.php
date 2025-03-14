<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Laporan;
use App\Models\laporanApi;


class WhatsAppController extends Controller
{
    public function index()
    {
        $laporanApi = new laporanApi();
        $laporan = $laporanApi->getLaporanApi();

        $today = now()->toDateString(); // Format: "YYYY-MM-DD"
        $laporanHariIni = collect($laporan)->filter(function ($data) use ($today) {
            return \Carbon\Carbon::parse($data['tanggal'])->toDateString() === $today;
        })->count();

        $bulanIni = Carbon::now()->format('Y-m'); // Format: 2025-03
        $bulanLalu = Carbon::now()->subMonth()->format('Y-m'); // Format: 2025-02

        // Hitung jumlah laporan bulan ini
        $jumlahBulanIni = collect($laporan)->filter(function ($data) use ($bulanIni) {
            return Carbon::parse($data['tanggal'])->format('Y-m') === $bulanIni;
        })->count();

        // Hitung jumlah laporan bulan lalu
        $jumlahBulanLalu = collect($laporan)->filter(function ($data) use ($bulanLalu) {
            return Carbon::parse($data['tanggal'])->format('Y-m') === $bulanLalu;
        })->count();

        // Hitung persentase perubahan
        if ($jumlahBulanLalu > 0) {
            $persentase = (($jumlahBulanIni - $jumlahBulanLalu) / $jumlahBulanLalu) * 100;
        } else {
            $persentase = $jumlahBulanIni > 0 ? 100 : 0; // Jika bulan lalu 0, anggap kenaikan 100%
        }

        $data = array(
            'head'              => "Dashboard",
            'title'             => "Dashboard",
            'menu'              => "Dashboard",
            'laporan'           => $laporan,
            'laporanHariIni'    => $laporanHariIni,
            'jumlahBulanLalu'   => $jumlahBulanLalu,
            'jumlahBulanIni'    => $jumlahBulanIni,
            'persentase'        => $persentase
        );
        return view('dashboard/index')->with($data);
    }
}
