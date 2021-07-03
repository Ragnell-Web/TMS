<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class CustomerStatusController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $customer_status;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->customer_status = \Config::get('rest.customer_status');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $customerList = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_status . 'list');
    	return view('tms.acc.customer_status')->with('customerList',$customerList['data']);
    }
    public function updateAr(Request $request)
    {
        $updateAr = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->customer_status . 'updateAr',[
            'ar_update'=>$request->input('ar_update')
        ]);
    }

}