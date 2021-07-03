<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class ModifyPOController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $modify_po;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->modify_po = \Config::get('rest.modify_po');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    	return view('tms.acc.modify_po');
    }
    public function getPO(Request $request)
    {
        $getPO = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->modify_po . 'getPO');
        return $getPO['data'];
    }
    public function postPO(Request $request)
    {
        $postPO = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->modify_po . 'postPO',[
            'po_no'=>$request->input('po_no')
        ]);
        return $postPO['data'];
    }
    public function updatePO(Request $request)
    {
        $updatePO = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->modify_po . 'updatePO',[
            'po_no2'=>$request->input('po_no2'),
            'po_no'=>$request->input('po_no')
        ]);
        return $updatePO['data'];
    }
}