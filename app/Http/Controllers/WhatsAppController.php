<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Laporan;

class WhatsAppController extends Controller
{
    public function index()
    {
        $laporan = Laporan::orderBy('created_at', 'desc')->get();
        // dd($laporan);
        $data = array(
            'laporan'           => $laporan,
        );
        return view('dashboard/index')->with($data);
    }
}
