<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class laporanApi extends Model
{
    public function getLaporanApi(){
        try {
            $response = Http::timeout(30)->get("http://localhost:3060/api/laporan");
            $data = $response['data'];
            $collection = collect($data);
    
        } catch (\Throwable $th) {
            $collection = null;
        }
        return $collection;
    }
}
