<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Models\laporanApi;


class AdminController extends Controller
{
    public function index(){
        $api = new laporanApi();
        $admin = $api->getAdminApi();
        $data = array(
            'head'              => "Tabel",
            'title'             => "Tabel",
            'menu'              => "Admin User",
            'admin'           => $admin,
        );
        return view('tabel/admin')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'nomor_admin' => 'required|string',
            'nama' => 'required|string',
        ]);
        
        // Data yang akan diupdate
        $data = [
            'nomor_admin'       => $request->nomor_admin,
            'nama'              => $request->nama, 
            'level'             => 'superadmin',
            'tanggal_dibuat'    => date('Y-m-d H:i:s'), 
        ];


        $url = "http://157.15.124.34:3030/api/admin-users";
        
        // Kirim PUT request ke API Node.js
        try {
            $response = Http::post($url, $data);
            // dd($response);
            if ($response->successful()) {
                return redirect('/admin_user')->with('success', 'Admin berhasil di tambah.');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server Node.js',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $url = "http://157.15.124.34:3030/api/admin-users/".$id;
        
        try {
            $response = Http::delete($url);
            if ($response->successful()) {
                return redirect('/admin_user')->with('success', 'Banned user berhasil di hapus.');
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
