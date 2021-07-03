<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class RekapitulasiIIController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $rekapitulasi_ii;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->rekapitulasi_ii = \Config::get('rest.rekapitulasi_ii');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $datas = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->rekapitulasi_ii . 'list');
    	return view('tms.acc.rekapitulasi_ii')->with('datas',$datas['data']);
    }
    public function getPartNo(Request $request)
    {
        $getPartNo = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->rekapitulasi_ii . 'getPartNo');
        return $getPartNo['data'];
    }
    public function getCustomer(Request $request)
    {
        $getCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->rekapitulasi_ii . 'getCustomer');
        return $getCustomer['data'];
    }
    public function getSJ(Request $request)
    {
        $getCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->rekapitulasi_ii . 'getSJ');
        return $getCustomer['data'];
    }

}