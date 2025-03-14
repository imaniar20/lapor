<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use voku\helper\AntiXSS;

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
            'menu'              => "Pengaduan",
            'laporan'           => $laporan,
        );
        return view('tabel/index')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $antiXss = new AntiXSS();
        $id = $antiXss->xss_clean($request->input('id'));
        $laporan = Laporan::findOrFail($id);
        
        $cleanedData = [
            'validasi'  => $antiXss->xss_clean($request->input('status')),
        ];
        
        $laporan->update($cleanedData);

        return redirect('/pengaduan')->with('success', 'Laporan berhasil diubah.');
    }
}
