<?php

namespace App\Http\Controllers;
use App\Models\Bankje;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    //
    public function index(Request $request) {
        $stats=[];
        $stats["noBankjes"]=Bankje::where("typeBankje","=","bankje")->count();
        $stats["noPicnicBankjes"]=Bankje::where("typeBankje","=","picnicbankje")->count();
        $stats["noSchuilhutten"]=Bankje::where("typeBankje","=","schuilhut")->count();

        $stats["noAdds"]=Log::where("action","=","add")->count();
        $stats["noDeletes"]=Log::where("action","=","delete")->count();
        $stats["noTouches"]=Log::where("action","=","touch")->count();

              
        // return $logs;
        return view('statistics',$stats);
        // $users['touches']=DB::table('logs')->select('ip','action')->where('action','=','touch')->get()->groupBy('ip');
        // return $users;
        // $logs=Log::where("action","=","add")->get()->sortBy('ip')->pluck('ip')->countBy();
        // return $logs;
       
    }
}
