<?php

namespace App\Http\Controllers;

use App\Models\Bankje;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankjeController extends Controller
{
    public function index(Request $request)
    {
        if($request->number) {
            $number=$request->number;
        } else {
            $number=1;
        }
        
        if ($request->path() == "api/area/test") {
            $lngLow = 6.13650;
            $lngHigh = 6.21054;
            $latLow = 51.40751;
            $latHigh = 51.45216;
        } else {
            $lngLow = $request->lngLow;
            $lngHigh = $request->lngHigh;
            $latLow = $request->latLow;
            $latHigh = $request->latHigh;
        }

        $bankjes = DB::table('bankjes')
            ->select("id", "typeBankje", "Latitude", "Longitude", "status")
            ->where('status', '<>', 'deleted')
            ->whereBetween('Latitude', [$latLow, $latHigh])
            ->whereBetween('Longitude', [$lngLow, $lngHigh])  
            ->get()
            ->shuffle();

            $length=$bankjes->count();
            
            $bankjes=$bankjes->take($number);

        return $bankjes;
    }

    public function delete(Bankje $bankje, Request $request)
    {
        // return($request);
        $bankje->status = "deleted";
        $bankje->save();

        // Fill the log
        $log= new Log;
        $log->ip=$request->ip();       
        $log->action="delete";
        $log->bankje_id=$bankje->id;      
        $log->save();

        return $bankje; //Laravel returns 404 if record does not exist
    }

    public function store(Request $request)
    {
        // Validation will generate a 422 status when it fails
        $request->validate([
            'typeBankje' => 'required|in:bankje,picnicbankje,schuilhut',
            'lat' => 'numeric|required',
            'lng' => 'numeric|required',
        ]);

        $bankje = new Bankje;
        $bankje->typeBankje = $request->typeBankje;
        $bankje->Latitude = $request->lat;
        $bankje->Longitude = $request->lng;
        $bankje->source = "user";
        $bankje->status = "added";
        $bankje->save();

        // Fill the log
        $log= new Log;
        $log->ip=$request->ip();       
        $log->action="add";
        $log->bankje_id=$bankje->id;      
        $log->save();

        return $bankje;
    }

    public function touch(Request $request) {
        $log=new Log;
        $log->ip=$request->ip();       
        $log->action="touch";
        $log->Lat=$request->lat;
        $log->Lng=$request->lng;
        $log->save();
        return "Server touched";
    }

    public function addedDeleted(Request $request)    //Retrieves added and deleted benches 
    {
        if($request->number) {
            $number=$request->number;
        } else {
            $number=1;
        }

            $lngLow = $request->lngLow;
            $lngHigh = $request->lngHigh;
            $latLow = $request->latLow;
            $latHigh = $request->latHigh;

        $bankjes = DB::table('bankjes')
            ->select("id", "typeBankje", "Latitude", "Longitude", "status")
            ->where('status', 'deleted')
            ->orWhere('status','added')
            ->whereBetween('Latitude', [$latLow, $latHigh])
            ->whereBetween('Longitude', [$lngLow, $lngHigh])  
            ->get()
            ->shuffle();

            $length=$bankjes->count();
            
            $bankjes=$bankjes->take($number);

        return $bankjes;
    }

    
}
