<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class AccCustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */   
    
    private $api_key;
    private $customer_invoice;
    private $api_url;
    public function __construct()
    {
        $this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->customer_invoice = \Config::get('rest.customer_invoice');
        $this->api_url = \Config::get('rest.api_url');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //print_r($this->api_key);exit;
        $datas = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_invoice . 'list');
        //print_r($datas['data']);exit;   
        return view('tms.acc.customer_invoice')->with('datas', $datas['data']);
    }
    public function add(Request $request)
    {

        $datas = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asForm()->post($this->api_url . $this->customer_invoice . 'add', [
            'invoice' => $request->input('invoice'), 
            'inv_type' => $request->input('inv_type'),
            'ref_no' => $request->input('ref_no'),
            'period' => $request->input('atas_nama'),
            'company' => $request->input('company')
        ]);

        return redirect()->route('ar_Index');
    }

}