<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;


class TtfEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $api_key;
    private $customer_invoice;
    private $api_url;
    private $ttf_arh;
    private $ttf_arl;
    private $ttf_entry;
    private $detail_customer;
    private $customer;

    public function __construct()
    {
        $this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->customer_invoice = \Config::get('rest.customer_invoice');
        $this->api_url = \Config::get('rest.api_url');
        $this->ttf_arh = \Config::get('rest.ttf_arh');
        $this->ttf_arl = \Config::get('rest.ttf_arl');
        $this->ttf_entry = \Config::get('rest.ttf_entry');
        $this->detail_customer = \Config::get('rest.detail_customer');
        $this->customer = \Config::get('rest.customer');
    }

    public function index()
    {
        $datasInvoices= Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_invoice . 'list');
        $getAccCustomerInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->customer_invoice . 'show');
            // print_r($datasTtfArhLast['data']);exit;
        return view('tms.acc.ttf_entry')->with('datasInvoices', $datasInvoices['data'])->with('getAccCustomerInvoice',$getAccCustomerInvoice['data']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->filled('amount_tot')) {
            $addCustomerInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->ttf_entry . 'store',[
            'ttf_no'=>$request->input('ttf_no'),
            'custcode'=>$request->input('custcode'),
            'nu'=>$request->input("nu"),
            'invoice'=>$request->input('invoice'),
            'kw_no'=>$request->input('kw_no'),
            'ref_no'=>$request->input('ref_no'),
            'tax_no'=>$request->input('tax_no'),
            'inv_date'=>$request->input('inv_date'),
            'inv_due'=>$request->input('inv_due'),
            'received'=>$request->input('inv_date'),
            'valas'=>$request->input('valas'),
            'amount_tot'=>$request->input('amount_tot')
        ]);
            // print_r($this->api_url . $this->ttf_entry . 'store');exit;
        return $addCustomerInvoice['data'];
        } else {
            $addCustomerInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->ttf_entry . 'store',[
            'ttf_no'=>$request->input('ttf_no'),
            'custcode'=>$request->input('custcode'),
            'nu'=>$request->input("nu"),
            'invoice'=>$request->input('invoice'),
            'kw_no'=>$request->input('kw_no'),
            'ref_no'=>$request->input('ref_no'),
            'tax_no'=>$request->input('tax_no'),
            'inv_date'=>$request->input('inv_date'),
            'inv_due'=>$request->input('inv_due'),
            'received'=>$request->input('inv_date'),
            'valas'=>$request->input('valas')
        ]);
            // print_r($this->api_url . $this->ttf_entry . 'store');exit;
        return $addCustomerInvoice['data'];
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $datasTtfArhLast = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->ttf_entry . 'list');

        return $datasTtfArhLast['data'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getCustomers(Request $request)
    {
        $datasCustomers = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->customer . 'edit',[
            'id'=>$request->input('id')
        ]);
        // $data = [
        //     'datasCustomers'=>$datasCustomers['data']
        // ];
        return $datasCustomers['data'];
    }
    public function getInvoice(Request $request)
    {
        $getInvoice = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->ttf_entry . 'getInvoice',
        [
            'id'=>$request->input('id')
        ]);

        return $getInvoice['data'];
    }
    public function getEntryTtfTbl(Request $request)
    {
        $getEntryTtfTbl = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->ttf_entry . 'show');
        return $getEntryTtfTbl['data'];
    }
    public function getTtfWhereNo(Request $request)
    {
        $getTtfWhereNo = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->get($this->api_url . $this->ttf_entry . 'getTtfWhereNo',
        [
            'ttf_no'=>$request->input('ttf_no')
        ]);
        return $getTtfWhereNo['data'];
    }
    public function addTtfEntry(Request $request)
    {
        $addTtfEntry = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->ttf_entry . 'addTtfEntry',[
            'ttf_no'=>$request->input('ttf_no'),
            'ref_no'=>$request->input('ref_no'),
            'written'=>$request->input('written'),
            'custcode'=>$request->input('custcode'),
            'company'=>$request->input('company'),
            'valas'=>$request->input('valas'),
            'total_inv'=>$request->input('total_inv'),
            'total_amt'=>$request->input('total_amt'),
            'remark'=>$request->input('remark'),
            'operator'=>$request->input('operator')
        ]);

        return $addTtfEntry['data'];
    }
    public function editTtfEntry(Request $request)
    {
        $editTtfEntry = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->ttf_entry . 'editTtfEntry',[
            'ttf_no'=>$request->input('ttf_no'),
            'ref_no'=>$request->input('ref_no'),
            'written'=>$request->input('written'),
            'custcode'=>$request->input('custcode'),
            'company'=>$request->input('company'),
            'valas'=>$request->input('valas'),
            'total_inv'=>$request->input('total_inv'),
            'total_amt'=>$request->input('total_amt'),
            'remark'=>$request->input('remark'),
            'operator'=>$request->input('operator')
        ]);

        return $editTtfEntry['data'];
    }
    public function updateTtfEntry(Request $request)
    {
        $updateTtfArh = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->put($this->api_url . $this->ttf_arh . 'update',[
            'ttf_no'=>$request->input('ttf_no'),
            'ref_no'=>$request->input('ref_no'),
            'written'=>$request->input('inv_date'),
            'custcode'=>$request->input('custcode'),
            'valas'=>$request->input('valas'),
            'total_amt'=>$request->input('amount_tot'),
            'remark'=>$request->input('remark')
            // print_r($addTtfArl['data']);exit;
        ]);
        $updateTtfArl = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->asJson()->post($this->api_url . $this->ttf_arl . 'update',[
            'ttf_no'=>$request->input('ttf_no'),
            'received'=>$request->input('received'),
            'valas'=>$request->input('dollar'),
            'invoice'=>$request->input('invoice'),
            'ref_no'=>$request->input('ref_no'),
            'tax_no'=>$request->input('tax_no'),
            'kw_no'=>$request->input('kw_no'),
            'inv_date'=>$request->input('inv_date'),
            'inv_due'=>$request->input('inv_due'),
            'amount_tot'=>$request->input('amount_tot'),
            'custcode'=>$request->input('custcode')
        ]);

    }
}
