<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class CLTotalController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $customer_ledger_total;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->customer_ledger_total = \Config::get('rest.customer_ledger_total');
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
        ])->get($this->api_url . $this->customer_ledger_total . 'list');
    	return view('tms.acc.customer_ledger_total')->with('datas',$datas['data']);
    }
    public function getCustomer(Request $request)
    {
        $getCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_ledger_total . 'getCustomer');
        return $getCustomer['data'];
    }
}