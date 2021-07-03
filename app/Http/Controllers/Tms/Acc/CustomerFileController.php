<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class CustomerFileController extends Controller
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
    private $detail_invoice;
    private $customer_file;
    public function __construct()
    {
        $this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->customer_invoice = \Config::get('rest.customer_invoice');
        $this->api_url = \Config::get('rest.api_url');
        $this->surat_jalan = \Config::get('rest.surat_jalan');
        $this->detail_invoice = \Config::get('rest.detail_invoice');
        $this->customer_file = \Config::get('rest.customer_file');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_file . 'list');

        return view('tms.acc.customer_file')->with('getCustomer',$getCustomer['data']);
    }
    public function create(Request $request)
    {
        $addCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->customer_file . 'create',[
            'custcode'=>$request->input('custcode'),
            'cus_group'=>$request->input('cus_group'),
            'branch'=>$request->input('branch'),
            'warehouse'=>$request->input('warehouse'),
            'company'=>$request->input('company'),
            'industry'=>$request->input('pt'),
            'entered'=>$request->input('entered'),
            'contact'=>$request->input('contact'),
            'address1'=>$request->input('address1'),
            'do_addr1'=>$request->input('do_addr1'),
            'address2'=>$request->input('address2'),
            'do_addr2'=>$request->input('do_addr2'),
            'address3'=>$request->input('address3'),
            'do_addr3'=>$request->input('do_addr3'),
            'address4'=>$request->input('address4'),
            'do_addr4'=>$request->input('do_addr4'),
            'phone'=>$request->input('phone'),
            'fax'=>$request->input('fax'),
            'glar'=>$request->input('glar'),
            'hp'=>$request->input('hp'),
            'npwp'=>$request->input('npwp'),
            'pl_by'=>$request->input('pl_by'),
            'email'=>$request->input('email'),
            'termofpay'=>$request->input('termofpay'),
            'term_dn'=>$request->input('term_dn'),
        ]);
        return $addCustomer['data'];
    }
    public function getCustomer(Request $request)
    {
        $datasCustomers = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_file . 'getCustomer');

        return $datasCustomers['data'];
    }
    public function getCustomerWhereCustcode(Request $request)
    {
        $getCustomerWhereCustcode = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->customer_file . 'getCustomerWhereCustcode',[
            "custcode"=>$request->input('custcode')
        ]);

        return $getCustomerWhereCustcode['data'];
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
        $editCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->customer_file . 'update',[
            'custcode'=>$request->input('custcode'),
            'cus_group'=>$request->input('cus_group'),
            'branch'=>$request->input('branch'),
            'warehouse'=>$request->input('warehouse'),
            'company'=>$request->input('company'),
            'industry'=>$request->input('pt'),
            'entered'=>$request->input('entered'),
            'contact'=>$request->input('contact'),
            'address1'=>$request->input('address1'),
            'do_addr1'=>$request->input('do_addr1'),
            'address2'=>$request->input('address2'),
            'do_addr2'=>$request->input('do_addr2'),
            'address3'=>$request->input('address3'),
            'do_addr3'=>$request->input('do_addr3'),
            'address4'=>$request->input('address4'),
            'do_addr4'=>$request->input('do_addr4'),
            'phone'=>$request->input('phone'),
            'fax'=>$request->input('fax'),
            'glar'=>$request->input('glar'),
            'hp'=>$request->input('hp'),
            'npwp'=>$request->input('npwp'),
            'pl_by'=>$request->input('pl_by'),
            'email'=>$request->input('email'),
            'termofpay'=>$request->input('termofpay'),
            'term_dn'=>$request->input('term_dn'),
        ]);
        return $editCustomer['data'];
    }
    public function delete(Request $request)
    {

        $deleteCustomer = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->delete($this->api_url . $this->customer_file. 'delete',[
            'custcode'=>$request->input('custcode')
        ]);
        // print_r($this->api_url . $this->add_customer_from_sj . 'delete');exit;
        return $deleteCustomer['data'];
    }

}