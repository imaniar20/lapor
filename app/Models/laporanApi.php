<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class laporanApi extends Model
{
    public function getLaporanApi(){
        try {
            $response = Http::timeout(30)->get("http://157.15.124.34:3030/api/laporan");
            $data = $response['data'];
            $collection = collect($data);
    
        } catch (\Throwable $th) {
            $collection = null;
        }
        return $collection;
    }

    public function getAdminApi(){
        try {
            $response = Http::timeout(30)->get("http://157.15.124.34:3030/api/admin-users");
            $data = $response['data'];
            $collection = collect($data);
    
        } catch (\Throwable $th) {
            $collection = null;
        }
        return $collection;
    }

    public function getBannedApi(){
        try {
            $response = Http::timeout(30)->get("http://157.15.124.34:3030/api/banned-users");
            $data = $response['data'];
            $collection = collect($data);
    
        } catch (\Throwable $th) {
            $collection = null;
        }
        return $collection;
    }
}
