<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class ListStandartController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $list_standart;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->list_standart = \Config::get('rest.list_standart');
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
        ])->get($this->api_url . $this->list_standart . 'list');
    	return view('tms.acc.list_standart')->with('datas',$datas['data']);
    }
    public function print(Request $request)
    {
        $datas = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->list_standart . 'list');
        return view('tms.acc.print.list_standart')->with('datas',$datas['data']);
    }
    public function getInvoice(Request $request)
    {
        $getInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->list_standart . 'getInvoice');
        return $getInvoice['data'];
    }
    public function getCustomer(Request $request)
    {
        $getCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->list_standart . 'getCustomer');
        return $getCustomer['data'];
    }

}