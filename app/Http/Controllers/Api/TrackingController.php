<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracking;

class TrackingController extends Controller
{
    public $successStatus = 200;
    public function tracking()
    {
        $data = Tracking::all();
        return response()->json(
            ['status' => '200','data' => $data,'messege'=>'berhasil'], $this->successStatus);

    }
}
