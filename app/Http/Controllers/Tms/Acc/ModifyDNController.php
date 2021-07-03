<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class ModifyDNController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $modify_dn;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->modify_dn = \Config::get('rest.modify_dn');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    	return view('tms.acc.modify_dn');
    }
    public function getDN(Request $request)
    {
        $getDN = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->modify_dn . 'getDN');
        return $getDN['data'];
    }
    public function postDN(Request $request)
    {
        $postDN = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->modify_dn . 'postDN',[
            'dn_no'=>$request->input('dn_no')
        ]);
        return $postDN['data'];
    }
    public function updateDN(Request $request)
    {
        $updateDN = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->modify_dn . 'updateDN',[
            'dn_no2'=>$request->input('dn_no2'),
            'dn_no'=>$request->input('dn_no')
        ]);
        return $updateDN['data'];
    }
}