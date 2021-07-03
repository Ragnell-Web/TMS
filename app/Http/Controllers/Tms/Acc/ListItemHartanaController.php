<?php

namespace App\Http\Controllers\Tms\Acc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\Http;

class ListItemHartanaController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	private $api_key;
    private $api_url;
    private $list_item_hartana;


    public function __construct()
    {
    	$this->middleware('auth');
    	$value = \Config::get('rest.api_key');
        //print_r('construct ' . \Config::get('rest.api_key'));exit;
        $this->api_key = str_replace('base64:', '', $value);
        $this->api_url = \Config::get('rest.api_url');
        $this->list_item_hartana = \Config::get('rest.list_item_hartana');
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
        ])->get($this->api_url . $this->list_item_hartana . 'list');
    	return view('tms.acc.list_item_hartana')->with('datas',$datas['data']);
    }
    public function getItem(Request $request)
    {
        $getItem = Http::withHeaders([
            'Authorization' => $this->api_key,
        ])->get($this->api_url . $this->list_item_hartana . 'getItem');
        return $getItem['data'];
    }
}