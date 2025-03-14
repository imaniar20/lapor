<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use voku\helper\AntiXSS;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Laporan;
use App\Models\laporanApi;

class TabelController extends Controller
{
    public function index()
    {
        $laporanApi = new laporanApi();
        $laporan = $laporanApi->getLaporanApi();
        $data = array(
            'head'              => "Tabel",
            'title'             => "Tabel",
            'menu'              => "Pengaduan",
            'laporan'           => $laporan,
        );
        return view('tabel/index')->with($data);
    }

    public function update(Request $request, $id)
    {
        $antiXss = new AntiXSS();
        
        $id = $antiXss->xss_clean($request->input('id'));
        
        // Validasi input
        $request->validate([
            'kategori' => 'nullable|string',
            'nama' => 'nullable|string',
            'alamat' => 'nullable|string',
            'nik' => 'nullable|string',
            'judul' => 'nullable|string',
            'isi' => 'nullable|string',
            'gambar_path' => 'nullable|string',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Data yang akan diupdate
        $data = $request->only([
            'kategori', 'nama', 'alamat', 'nik', 'judul', 
            'isi', 'gambar_path', 'status', 'keterangan'
        ]);

        // URL API Node.js
        $url = "http://localhost:3060/api/laporan/{$id}";

        // Kirim PUT request ke API Node.js
        try {
            $response = Http::put($url, $data);

            if ($response->successful()) {
                return redirect('/pengaduan')->with('success', 'Laporan berhasil diubah.');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server Node.js',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request){
        $antiXss = new AntiXSS();

        $request->validate([
            'date1' => 'required',
            'date2' => 'required',
        ]);

        $date1 = $antiXss->xss_clean($request->input('date1'));
        $date1 = Carbon::parse($date1)->startOfDay()->format('Y-m-d\TH:i:s');

        $date2 = $antiXss->xss_clean($request->input('date2'));
        $date2 = Carbon::parse($date2)->endOfDay()->format('Y-m-d\TH:i:s');

        $laporanApi = new laporanApi();
        $laporan = $laporanApi->getLaporanApi();
        $export = $laporan->filter(function ($item) use ($date1, $date2) {
            $tanggal = Carbon::parse($item['tanggal']);
            return $tanggal->between(Carbon::parse($date1), Carbon::parse($date2));
        });
        
        // Grouping dan hitung total
        $status = $export->groupBy('status')->map->count();
        $defaultStatuses = [
            "Proses" => 0,
            "Menunggu" => 0,
            "Tidak Valid" => 0,
            "Selesai" => 0,
        ];
        
        $statusSummary = array_merge($defaultStatuses, $status->all());
        
        // dd($statusSummary);

        $start = Carbon::parse($date1)->format('d M Y');
        $end = Carbon::parse($date2)->format('d M Y');
        $data = array(
            'title'             => 'Laporan Pengaduan',
            'date1'             => $date1,
            'date2'             => $date2,
            'start'             => $start,
            'end'               => $end,
            'export'            => $export,
            'summary'           => $statusSummary,
        );
        $pdf = Pdf::loadView('pdf.laporan', $data);
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream('laporan.pdf');
    }
}
