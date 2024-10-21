<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    //
    public function getDistricts($province_id)
    {
        $districts = DB::table('district')->where('province_id', $province_id)->get();
        return response()->json($districts);
    }

    public function getWards($district_id)
    {
        $wards = DB::table('wards')->where('district_id', $district_id)->get();
        return response()->json($wards);
    }
}
