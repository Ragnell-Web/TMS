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
    private $surat_jalan;
    private $api_url;
    private $detail_customer;
    private $add_customer_from_sj;
    public function __construct()
    {
        $this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->customer_invoice = \Config::get('rest.customer_invoice');
        $this->api_url = \Config::get('rest.api_url');
        $this->surat_jalan = \Config::get('rest.surat_jalan');
        $this->detail_customer = \Config::get('rest.detail_customer');
        $this->add_customer_from_sj = \Config::get('rest.add_customer_from_sj');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //print_r($this->api_key);exit;
        $datasInvoices= Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_invoice . 'list');

        //print_r($datas['data']);exit;
        $datasSuratJalan = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->surat_jalan . 'list');
        return view('tms.acc.customer_invoice')->with('datasInvoices', $datasInvoices['data'])->with('datasSuratJalan',$datasSuratJalan['data']);
    }
    public function create(Request $request)
    {

        $datas = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asForm()->post($this->api_url . $this->customer_invoice . 'store', [
            'invoice' => $request->input('invoice'),
            'inv_type' => $request->input('inv_type'),
            'ref_no' => $request->input('ref_no'),
            'period' => $request->input('atas_nama'),
            'company' => $request->input('company')
        ]);

        return redirect()->route('ar_Index')->with('datas',$datas['data']);
    }
    public function getCustomer(Request $request)
    {
        $datasCustomers = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->detail_customer . 'edit',[
            'id'=>$request->input('id')
        ]);
        // $data = [
        //     'datasCustomers'=>$datasCustomers['data']
        // ];

        return $datasCustomers['data'];
    }
    public function getSJ(Request $request)
    {
        $datasAddCustomers = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->add_customer_from_sj . 'list',[
            'custcode'=>$request->input('cust_id')
        ]);
        return $datasAddCustomers['data'];
    }

}