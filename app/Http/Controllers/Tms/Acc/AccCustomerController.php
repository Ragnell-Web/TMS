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
    private $add_do_dtl;
    private $detail_invoice;
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
        $this->add_do_dtl = \Config::get('rest.add_do_dtl');
        $this->detail_invoice = \Config::get('rest.detail_invoice');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // print_r($this->api_key);exit;
        $datasInvoices= Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_invoice . 'list');
        // print_r($datasInvoices['data']);exit;
        //print_r($datas['data']);exit;
        $datasSuratJalan = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->surat_jalan . 'list');
        return view('tms.acc.customer_invoice')->with('datasInvoices', $datasInvoices['data'])->with('datasSuratJalan',$datasSuratJalan['data']);
    }

    public function create(Request $request)
    {
        $addCustomerInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->customer_invoice . 'store',[
            'invoice'=>$request->input('invoice'),
            'custcode'=>$request->input('cust_id'),
            'contact'=>$request->input('contact'),
            'source'=>$request->input('source'),
            'company'=>$request->input('company'),
            'taxrate'=>$request->input('taxrate'),
            'period'=>$request->input('period'),
            'written'=>$request->input('written'),
            'ref_no'=>$request->input('ref_no'),
            'address1'=>$request->input('address1'),
            'address3'=>$request->input('address3'),
            'valas'=>$request->input('valas'),
            'rate'=>$request->input('rate'),
            'due'=>$request->input('due'),
            'glar'=>$request->input('glar'),
            'inv_type'=>$request->input('inv_type')
        ]);
            // print_r($addCustomerInvoice['data']);exit;
        return $addCustomerInvoice['data'];
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
            'cust_id'=>$request->input('cust_id')
        ]);
        $showInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->customer_invoice . 'filter',[
            'custcode'=>$request->input('cust_id')
        ]);
        
        return [$datasAddCustomers['data'],$showInvoice['data']];
    }
    public function getDoDtl(Request $request)
    {
        // print_r($this->api_url . $this->add_do_dtl . 'list');exit;
        $dataAddDoDtl = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->add_do_dtl . 'list',[
            'do_no'=>$request->input('do_no'),
            'do_no2'=>$request->input('do_no2'),
            'do_no3'=>$request->input('do_no3'),
            'do_no4'=>$request->input('do_no4'),
            'do_no5'=>$request->input('do_no5')
        ]);
        // print_r($this->add_do_dtl);exit;
        return $dataAddDoDtl['data'];
    }
    public function update(Request $request)
    {
        $updateDatasCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->detail_customer . 'update',[
            'custcode'=>$request->input('cust_id'),
            'contact'=>$request->input('contact'),
            'source'=>$request->input('source'),
            'company'=>$request->input('company'),
            'taxrate'=>$request->input('taxrate')
        ]);
        $updateDatasInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->detail_invoice . 'update',[
            'custcode'=>$request->input('cust_id'),
            'period'=>$request->input('period'),
            'written'=>$request->input('written'),
            'ref_no'=>$request->input('ref_no'),
            'address1'=>$request->input('address1'),
            'address3'=>$request->input('address3'),
            'valas'=>$request->input('valas'),
            'rate'=>$request->input('rate'),
            'due'=>$request->input('due'),
            'glar'=>$request->input('glar')
        ]);
            // print_r($updateDatasCustomer['data']);exit;
        return [$updateDatasCustomer['data'],$updateDatasInvoice['data']];
    }
    public function deleteSJ(Request $request)
    {

        $deleteSJ = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->delete($this->api_url . $this->add_customer_from_sj . 'delete',[
            'do_no'=>$request->input('do_no'),
            'custcode'=>$request->input('custcode')
        ]);
        // print_r($this->api_url . $this->add_customer_from_sj . 'delete');exit;
        return $deleteSJ['data'];
    }

}