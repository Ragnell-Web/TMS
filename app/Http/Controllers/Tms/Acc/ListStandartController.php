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

        $reportTitle = $request->input('reportTitle');

        // nembak ke b/e
            if(
                    $request->filled('invoice1') AND
                    $request->filled('written1') AND
                    $request->filled('custcode1')
                ){
                $dataInvoice = Http::withHeaders([
                'Authorization' => $this->api_key,
                ])->asJson()->post($this->api_url . $this->list_standart . 'print',[
                    'invoice1'=>$request->input('invoice1'),
                    'invoice2'=>$request->input('invoice2'),
                    'written1'=>$request->input('written1'),
                    'written2'=>$request->input('written2'),
                    'custcode1'=>$request->input('custcode1'),
                    'custcode2'=>$request->input('custcode2'),
                ]);
                return view('tms.acc.print.list_standart')->with('datas',$datas['data'])->with('dataInvoice',$dataInvoice['data'])->with('reportTitle',$reportTitle);
            }elseif ($request->filled('invoice1')) {
                $dataInvoice = Http::withHeaders([
                'Authorization' => $this->api_key,
                ])->asJson()->post($this->api_url . $this->list_standart . 'print',[
                    'invoice1'=>$request->input('invoice1'),
                    'invoice2'=>$request->input('invoice2'),
                ]);
                return view('tms.acc.print.list_standart')->with('datas',$datas['data'])->with('dataInvoice',$dataInvoice['data'])->with('reportTitle',$reportTitle);
            }elseif ($request->filled('written1')) {
                $dataInvoice = Http::withHeaders([
                'Authorization' => $this->api_key,
                ])->asJson()->post($this->api_url . $this->list_standart . 'print',[
                    'written1'=>$request->input('written1'),
                    'written2'=>$request->input('written2'),
                ]);
                return view('tms.acc.print.list_standart')->with('datas',$datas['data'])->with('dataInvoice',$dataInvoice['data'])->with('reportTitle',$reportTitle);
            }elseif ($request->filled('custcode1')) {
                $dataInvoice = Http::withHeaders([
                'Authorization' => $this->api_key,
                ])->asJson()->post($this->api_url . $this->list_standart . 'print',[
                    'custcode1'=>$request->input('custcode1'),
                    'custcode2'=>$request->input('custcode2'),
                ]);
                return view('tms.acc.print.list_standart')->with('datas',$datas['data'])->with('dataInvoice',$dataInvoice['data'])->with('reportTitle',$reportTitle);
            }

        //response dari b/e
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