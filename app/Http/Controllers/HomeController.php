<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use CarbonPeriod;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $awal   = "2021-07-01";
        $akhir  = date("Y-m-d");
        $period = CarbonPeriod::create($awal, '1 month', $akhir);

        $bulan  = array();
        foreach ($period as $dt) {
                $bulan[] = Carbon::parse($dt)->translatedFormat('F Y');
        }

        $data['title']              = 'Dashboard';
        
        
      
        //echo '<pre>',print_r(json_encode($users),1),'</pre>';
        //exit();
        return view('home')->with($data);
    }
}
