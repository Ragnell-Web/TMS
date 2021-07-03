<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class MaintainController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $maintain;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->maintain = \Config::get('rest.maintain');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $startInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->maintain . 'list');
        $getEfaktur = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->maintain . 'getEfaktur');
        $getEfPrint = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->maintain . 'getEfPrint');

    	return view('tms.acc.maintain_efaktur')->with('startInvoice',$startInvoice['data'])->with('getEfaktur',$getEfaktur['data'])->with('getEfPrint',$getEfPrint['data']);
    }
    public function getInvoice(Request $request)
    {
        $getInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->maintain . 'getInvoice');
        return $getInvoice['data'];
    }
    public function getEf_noWhere(Request $request)
    {
        $getEf_noWhere = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->maintain . 'getEf_noWhere',[
            'ef_no'=>$request->input('ef_no'),
        ]);
        return $getEf_noWhere['data'];
    }
    public function getInvoiceWhere(Request $request)
    {
        $getInvoiceWhere = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->maintain . 'getInvoiceWhere',[
            'invoice'=>$request->input('invoice'),
        ]);
        return $getInvoiceWhere['data'];
    }
    public function addInvoice(Request $request)
    {
        $addInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->maintain . 'addInvoice',[
            'start_inv'=>$request->input('start_inv'),
            'printed'=>$request->input('printed'),
            'end_inv'=>$request->input('end_inv'),
            'start_date'=>$request->input('start_date'),
            'end_date'=>$request->input('end_date'),
            'ef_text'=>$request->input('ef_text'),
        ]);
        return $addInvoice['data'];
    }
    public function updateEfPrint(Request $request)
    {
        $updateEfPrint = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->maintain . 'updateEfPrint',[
            'ef_no'=>$request->input('ef_no'),
            'ef_text'=>$request->input('ef_text'),
        ]);
        return $updateEfPrint['data'];
    }
    public function deleteEfPrint(Request $request)
    {
        $deleteEfPrint = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->delete($this->api_url . $this->maintain . 'deleteEfPrint',[
            'ef_no'=>$request->input('ef_no'),
        ]);
        return $deleteEfPrint['data'];
    }
}