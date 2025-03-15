<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Laporan;
use App\Models\laporanApi;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannedController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::middleware([CheckLogin::class])->group(function () {
        Route::get('/dashboard', function () {
            $laporanApi = new laporanApi();
            $laporan = $laporanApi->getLaporanApi();
            $today = now()->toDateString();
            $laporanHariIni = collect($laporan)->filter(function ($data) use ($today) {
                return \Carbon\Carbon::parse($data['tanggal'])->toDateString() === $today;
            })->count();

            $currentYear = date('Y');

            $laporanThisYear = collect($laporan)->filter(function($item) use ($currentYear) {
                return Carbon::parse($item['tanggal'])->year == $currentYear;
            });

            $groupedByMonth = $laporanThisYear->groupBy(function($item) {
                return Carbon::parse($item['tanggal'])->format('F');
            });

            $groupedCount = $groupedByMonth->map(function($group) {
                return $group->count();
            });

            $bulan = [
                'January'   => 0,
                'February'  => 0,
                'March'     => 0,
                'April'     => 0,
                'May'       => 0,
                'June'      => 0,
                'July'      => 0,
                'August'    => 0,
                'September' => 0,
                'October'   => 0,
                'November'  => 0,
                'December'  => 0,
            ];

            $totalPengaduan = array_merge($bulan, $groupedCount->toArray());

            $bulanIni = Carbon::now()->format('Y-m');
            $bulanLalu = Carbon::now()->subMonth()->format('Y-m');

            $jumlahBulanIni = collect($laporan)->filter(function ($data) use ($bulanIni) {
                return Carbon::parse($data['tanggal'])->format('Y-m') === $bulanIni;
            })->count();

            $jumlahBulanLalu = collect($laporan)->filter(function ($data) use ($bulanLalu) {
                return Carbon::parse($data['tanggal'])->format('Y-m') === $bulanLalu;
            })->count();

            if ($jumlahBulanLalu > 0) {
                $persentase = (($jumlahBulanIni - $jumlahBulanLalu) / $jumlahBulanLalu) * 100;
            } else {
                $persentase = $jumlahBulanIni > 0 ? 100 : 0;
            }

            $status = $laporan->groupBy('status')->map->count();
            $statusThisMonth = collect($laporan)->filter(function ($data) use ($bulanIni) {
                    return Carbon::parse($data['tanggal'])->format('Y-m') === $bulanIni;
                })->groupBy('status')->map->count();
                
            $defaultStatuses = [
                "Proses" => 0,
                "Menunggu" => 0,
                "Tidak Valid" => 0,
                "Selesai" => 0,
            ];
            $statusSummary = array_merge($defaultStatuses, $status->all());
            $statusSummaryThisMonth = array_merge($defaultStatuses, $statusThisMonth->all());


            $kategori = $laporan->groupBy('kategori')->map->count();
            $kategoriThisMonth = collect($laporan)->filter(function ($data) use ($bulanIni) {
                    return Carbon::parse($data['tanggal'])->format('Y-m') === $bulanIni;
                })->groupBy('kategori')->map->count();

            $defaultKategories = [
                "Infrastruktur" => 0,
                "Pendidikan" => 0,
                "Kesehatan" => 0,
                "Pelayanan ASN" => 0,
                "Penerangan Jalan Umum" => 0,
            ];
            $kategoriSummary = array_merge($defaultKategories, $kategori->all());
            $kategoriSummaryThisMonth = array_merge($defaultKategories, $kategoriThisMonth->all());

            $data = array(
                'head'              => "Dashboard",
                'title'             => "Dashboard",
                'menu'              => "Dashboard",
                'laporan'           => $laporan,
                'laporanHariIni'    => $laporanHariIni,
                'jumlahBulanLalu'   => $jumlahBulanLalu,
                'jumlahBulanIni'    => $jumlahBulanIni,
                'totalPengaduan'    => $totalPengaduan,
                'persentase'        => $persentase,
                'status'            => $statusSummary,
                'statusThisMonth'   => $statusSummaryThisMonth,
                'kategori'          => $kategoriSummary,
                'kategoriThisMonth' => $kategoriSummaryThisMonth
            );
            return view('dashboard/index')->with($data);
        })->name('dashboard');
    });
    
    Route::resource('/pengaduan', TabelController::class);
    Route::post('/pengaduan/export', [TabelController::class, 'export'])->name('pengaduan.export');
    
    Route::resource('/admin_user', AdminController::class);
    Route::resource('/banned_user', BannedController::class);
});