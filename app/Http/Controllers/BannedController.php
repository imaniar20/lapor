<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Models\laporanApi;

class BannedController extends Controller
{
    public function index(){
        $api = new laporanApi();
        $banned = $api->getBannedApi();
        $data = array(
            'head'              => "Tabel",
            'title'             => "Tabel",
            'menu'              => "Banned User",
            'banned'           => $banned,
        );
        return view('tabel/banned')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'nomor_user' => 'required|string',
            'alasan' => 'required|string',
        ]);
        
        // Data yang akan diupdate
        $data = [
            'nomor_user'        => $request->nomor_user,
            'waktu_mulai'       => date('Y-m-d H:i:s'), 
            'waktu_berakhir'    => '9999-12-31 23:59:59', 
            'alasan'            => $request->alasan, 
            'is_permanent'      => 1,
        ];


        $url = "http://157.15.124.34:3030/api/banned-users";
        
        // Kirim PUT request ke API Node.js
        try {
            $response = Http::post($url, $data);
            // dd($response);
            if ($response->successful()) {
                return redirect('/banned_user')->with('success', 'Banned user berhasil di tambah.');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server Node.js',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $nomor)
    {
        $url = "http://157.15.124.34:3030/api/banned-users/phone/".$nomor;
        
        try {
            $response = Http::delete($url);
            if ($response->successful()) {
                return redirect('/banned_user')->with('success', 'Banned user berhasil di hapus.');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server Node.js',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
