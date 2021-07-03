<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class InvoiceDOController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $invoice_do_item;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->invoice_do_item = \Config::get('rest.invoice_do_item');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    	return view('tms.acc.invoice_do_item');
    }
}