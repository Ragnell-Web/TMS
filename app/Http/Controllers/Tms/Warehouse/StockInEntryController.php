<?php

namespace App\Http\Controllers\Tms\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dbtbs\StockInEntry;
use App\Models\Dbtbs\Item;
use DataTables;
use Carbon\Carbon;
use Auth;
use Datetime;
use PDF;
use DB;
use Illuminate\Support\Str;
class StockInEntryController extends Controller
{
    public function indexStockInEntry ()
    {
        $getDate = Carbon::now()->format('d/m/Y');
        $getDate1 =  Carbon::now()->format('Y/m');
        $data_stin = new StockInEntry();
        $get_stinno = $data_stin->getStinNo();
        $stin = \DB::connection('db_tbs')->table('entry_stock_in_tbl')->selectRaw('itemcode')->count();
        $stin1 = \DB::connection('db_tbs')->table('entry_stock_in_tbl')->get();
        $stinCount = \DB::connection('db_tbs')->table('entry_stock_in_tbl')->count();
        return view('tms.warehouse.stock-in-entry.index', compact('get_stinno','getDate','getDate1','stin','stinCount','stin1'));
    }
    public function GetStindatatablesDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::connection('db_tbs')
                ->table('entry_stock_in_tbl')
                ->select('id_stin','in_no','created_date','posted', 'ref_no','staff',
                'remark_header','descript','period')
                ->where('voided','=', NULL)
                ->groupByRaw('in_no')
                ->get();

            return Datatables::of($data)
            ->editcolumn('posted', function($data){
                $dt = $data->posted;
                if ($dt != NULL) {
                    return Carbon::parse($dt)->format('d/m/Y');
                } else {
                    return "//";
                }
            })->editColumn('created_date', function($data){
                $dt = $data->created_date;
                if ($dt != NULL) {
                    return Carbon::parse($dt)->format('d/m/Y');
                } else {
                    return '//';
                }
            })
            ->rawColumns(['action'])
            ->editColumn('action', function($data){
                return view('tms.warehouse.stock-in-entry._actiondatatables._action',[
                    'model' => $data,
                    'url_print' => route('tms.warehouse.stock_in_entry_report', base64_encode($data->in_no))
                ]);
            })
            ->make(true);        
        }
    }
    public function getChoiceDataItemDatatablesStin(Request $request)
    {
        if ($request->ajax()) {
            $data = Item::query();
            return Datatables::of($data)->make(true);
        }
    }
    public function SysWarehouseStin(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::connection('db_tbs')
                    ->table('sys_warehouse')
                    ->select('warehouse_id','descript')
                    ->get();
            return Datatables::of($data)->make(true);        
        }
    }
    public function storeStockIn(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $rules = [
                'ref_no'=> 'required',
                 'types'=> 'required',
                 'itemcode.*'=> 'required',
                //  'descript.*'=> 'required',
                 'fac_qty.*'=> 'required'
            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'error'=> $validator->errors()->all()
                ]);
            }
            
            $getDate = Carbon::now()->format('d/m/Y');
            $data_stin = new StockInEntry();
            $get_stinno = $data_stin->getStinNo();
            $date = new Datetime;
            $getDate1 =  Carbon::now()->format('Y/m');
            $getSession = Auth::user()->FullName;
            $getItemcode = $request->itemcode;
            $stin_no = $get_stinno;
            $ref_no = $request->ref_no;
            $itemcode = $request->itemcode;
            $part_no = $request->part_no;
            $descript = $request->descript;
            $fac_unit = $request->fac_unit;
            $fac_qty = $request->fac_qty;
            $factor = $request->factor;
            $unit = $request->unit;
            $quantity = $request->quantity;
            $period =$request->period;
            $staff = $getSession;
            $remark_header = $request->remark_header;
            $remark_detail = $request->remark_detail;
            $types = $request->types;
            $created_date = Carbon::now();
            // $remark = $request->remark;
            // $po_no = $request->po_no;
            $data = $request->all();
            $periodCheck = $data['period'];
            // $check = StockOutEntry::where('itemcode', $itemcode)->get();
            $convert = Carbon::createFromFormat('Y-m',  $periodCheck)->format('Y');
            $convert2 = Carbon::createFromFormat('Y-m',  $periodCheck)->format('m');
            if (count($request->input('itemcode')) > 0) {
                $check =  DB::connection('db_tbs')
                ->table('stclose')
                ->whereYear('DATE','=',  $convert)
                ->whereMonth('DATE','=', $convert2)
                ->get();
             $msg = "Sudah closing tidak bisa entry";
             if ($check->isEmpty()) {
                foreach ($request->input('itemcode') as $item => $value) {
                    $data = array(
                        'in_no'=> $stin_no,
                        'remark_header'=>  Str::upper($remark_header),
                        'ref_no'=> Str::upper($ref_no),
                        'itemcode'=>$itemcode[$item],
                        'part_no'=>$part_no[$item],
                        'descript'=>$descript[$item],
                        'fac_unit'=>$fac_unit[$item],
                        'fac_qty'=>$fac_qty[$item],
                        'factor'=>$factor[$item],
                        'unit'=>$unit[$item],
                        'quantity'=>$quantity[$item],
                        'period'=> $period,
                        'staff'=>  $getSession,
                        'types'=>$types,
                        // 'operator'=> $getSession,
                        'created_date'=> $created_date,
                        'created_by'=> $getSession,
                        'remark_detail'=>$remark_detail[$item],
                        'branch'=> $request->branch
                    );
    
                    $get_data = StockInEntry::create($data);  
                }
                $get_count = $request->all();
                $get_itemcode = count($get_count['itemcode']);
                $get_quantity = $get_count['quantity'];
                $jumlah = 0;
                for ($i=0; $i < count($get_quantity) ; $i++) { 
                    $kalkulasi = $jumlah += $get_count['quantity'][$i];
                }
                date_default_timezone_set("Asia/Jakarta");
                $date = Carbon::now();
                $time = Carbon::now()->format('H:i:s');
                $status = "ADD";
                $in_no =  $get_stinno;
                $userstaff = Auth::user()->FullName;
                $note = 'Wh :' . $get_data['types'] . '/' . 'Item:'.  $get_itemcode .'/'. 'Qty:'. $kalkulasi;
                DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
                    'in_no' => $in_no, 
                    'date' => $date,
                    'time' => $time,
                    'status_change' => $status,
                    'user' => $userstaff,
                    'note' => $note 
                ]);
                
                return response()->json([
                    'status' => 'Successfully add new stock out'
                ]);
             } else {
                return response()->json([
                    'errors'=> $msg,
                    'checkdata'=> $check
                ]);
             }
            
            }
    }


    
}
public function showViewStin($id)
{
    $stinHeader   = StockInEntry::where('id_stin', $id)->first();
    $stinHeaderNo = $stinHeader->in_no;
    $stinDetail   = StockInEntry::select('id_stin',
        'in_no','ref_no','itemcode','part_no','descript','fac_unit','fac_qty','factor',
        'unit','quantity','period','staff','types','created_date','printed','voided',
        'posted','remark_header','remark_detail')   
    ->where('in_no', '=', $stinHeaderNo)
    ->get();
    $stinCount   = StockInEntry::select('id_stin',
        'in_no','ref_no','itemcode','part_no','descript','fac_unit','fac_qty','factor',
        'unit','quantity','period','staff','types','created_date','printed','voided',
        'posted','remark_header','remark_detail')   
    ->where('in_no', '=', $stinHeaderNo)
    ->count();            
    $output = [
        'header' => $stinHeader,
        'detail' => $stinDetail,
        'count'=> $stinCount
    ];

    return response()->json($output);
}

public function editStinEntry(Request $request, $id)
{
    $StinHeader   = StockInEntry::where('id_stin', $id)->first();
    // if (!empty($StinHeader->out_no)) {
        $StinHeaderNo = $StinHeader->in_no;
        $get_first_data   = StockInEntry::select('id_stin',
        'in_no','ref_no','itemcode','part_no','descript','fac_unit','fac_qty','factor',
        'unit','quantity','period','staff','types','staff','created_date','printed','voided',
        'posted','remark_detail')   
    ->where('in_no', '=', $StinHeaderNo)
    ->first();
    $StinCount   = StockInEntry::select('id_stin',
        'in_no','ref_no','itemcode','part_no','descript','fac_unit','fac_qty','factor',
        'unit','quantity','period','staff','types','staff','created_date','printed','voided',
        'posted','remark_header','remark_detail')   
    ->where('in_no', '=', $StinHeaderNo)
    ->count();    
    

    $output = [
        // 'in_no'=> $StinHeaderNo,
        'header' => $StinHeader,
        'detail' => $get_first_data,
        'count'=> $StinCount
    ];


        echo json_encode($output);
        exit;
    // } else {
    //     $StinHeader2   = StockInEntry::where('id_stin', $id)->first();
    //     $in_no = $StinHeader2->in_no;
    //     return response()->json([
    //         'msg'=> 'data sudah terhapus',
    //         'out_no'=> $out_no
    //     ]);
    // }

   

}
public function dashboardEditDetailStin($in_no)
{
     $data   = StockInEntry::select('id_stin',
        'in_no','ref_no','itemcode','part_no','descript','fac_unit','fac_qty','factor',
        'unit','quantity','period','staff','types','staff','created_date','printed','voided',
        'posted','remark_detail')   
    ->where('in_no','=', $in_no)
    // ->where('deleted_at', NULL)
    ->get();
    return Datatables::of($data)
    ->toJson(true);
}

public function updateStin(Request $request, $id)
{
  
    $get_modelstin = StockInEntry::find($id);
    $get_itemcode = $get_modelstin->itemcode;
    $get_inno = $get_modelstin->in_no;
    $get_ref_no = $get_modelstin->ref_no;
    $get_types = $get_modelstin->types;
    $get_branch = $get_modelstin->branch;
    $get_quantity = $get_modelstin->quantity;
    $get_remark_header = $get_modelstin->remark_header;
    $getSession = Auth::user()->FullName;
    $ref_no = $request->refs_no;
    $itemcode = $request->itemcode;
    $part_no = $request->part_no;
    $descript = $request->descript;
    $fac_unit = $request->fac_unit;
    $fac_qty = $request->fac_qty;
    $factor = $request->factor;
    $unit = $request->unit;
    $quantity = $request->quantity;
    $period = $get_modelstin->period;
    $types = $request->types;
    $created_date = Carbon::now();
    $remark_header = $request->remark_header;
    $remark_detail = $request->remark_detail;
    $po_no = $request->po_no;
    $branch = $request->branch; 
    $get_data = $request->all();
    $period = $get_modelstin->period;
    // dd($period);
    $convert = Carbon::createFromFormat('Y-m',  $period)->format('Y');
    $convert2 = Carbon::createFromFormat('Y-m',  $period)->format('m');
    // $get_item  = DB::connection('db_tbs')->table('entry_stock_in_tbl')->where('out_no', $get_inno)->count();
    if (isset($itemcode)) {
        $check =  DB::connection('db_tbs')
        ->table('stclose')
        ->whereYear('DATE','=',  $convert)
        ->whereMonth('DATE','=', $convert2)
        ->get();
        $msg = "Sudah di closing tidak bisa diedit";
        if ($check->isEmpty()) {
            if (count($itemcode) > 0) {
                foreach ($itemcode as $i => $v) {
                        $data = new StockInEntry;
                        $data->in_no = $get_inno;
                        $data->ref_no = Str::upper($get_ref_no);
                        $data->itemcode = $itemcode[$i];
                        $data->part_no = $part_no[$i];
                        $data->descript = $descript[$i];
                        $data->fac_unit = $fac_unit[$i];
                        $data->fac_qty = $fac_qty[$i];
                        $data->factor = $factor[$i];
                        $data->unit = $unit[$i];
                        $data->quantity = $quantity[$i];
                        $data->period = $period;
                        $data->staff = $getSession;
                        $data->types = $get_types;
                        $data->created_date = $created_date;
                        $data->created_by = Auth::user()->FullName;
                        // $data->updated_date = Carbon::now();
                        // $data->updated_by = Auth::user()->FullName;
                        $data->remark_header = Str::upper($get_remark_header);
                        $data->remark_detail = $remark_detail[$i];
                        // $data->po_no = $po_no;
                        $data->branch = $get_branch;
                        $data->save();
                    } 
                    
            }
            $updated = DB::connection('db_tbs')
            ->table('entry_stock_in_tbl')
            // ->select('itemcode')
            ->where('in_no', $get_inno)
            ->update([
                'updated_date'=> Carbon::now(),
                'updated_by'=> Auth::user()->FullName
            ]); 
           
            $counter = count($get_data['itemcode']);
            date_default_timezone_set("Asia/Jakarta");
            $get_quantity2 = $get_data['quantity'];
            $get_qty_before = DB::connection('db_tbs')
                                ->table('entry_stock_in_tbl')
                                ->select(DB::raw("SUM(quantity) as total"))
                                ->where('in_no', $get_inno)
                                ->get();
             $get_item = DB::connection('db_tbs')
                                ->table('entry_stock_in_tbl')
                                ->select('itemcode')
                                ->where('in_no', $get_inno)
                                ->count();                    
            $total = $get_qty_before[0]->total;                    
            $get_itemtotal = count($get_data['itemcode']);
            $itemtotal =  $get_itemtotal+= $get_item;
            $date = Carbon::now();
            $time = Carbon::now()->format('H:i:s');
            $status = "EDIT";
            $in_no =  $get_inno;
            $userstaff = Auth::user()->FullName;
            $note = 'Wh :' . $get_types  . '/' . 'Item:'. $get_item .'/'. 'Qty:'. ' ' . $total;
            DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
                'in_no' => $in_no, 
                'date' => $date,
                'time' => $time,
                'status_change' => $status,
                'user' => $userstaff,
                'note' => $note 
            ]);
    
           
            } else {               
                return response()->json([
                    'check'=> $check,
                    'errors'=> $msg
                ]);
                
            }
        }   else {
            // echo $get_types ;
            $get_item2 = DB::connection('db_tbs')
            ->table('entry_stock_in_tbl')
            ->select('itemcode')
            ->where('in_no', $get_inno)
            ->count(); 
            $get_item2 = DB::connection('db_tbs')
            ->table('entry_stock_in_tbl')
            // ->select('itemcode')
            ->where('in_no', $get_inno)
            ->update([
                'updated_date'=> Carbon::now(),
                'updated_by'=> Auth::user()->FUllName
            ]); 
            $get_qty_before2 = DB::connection('db_tbs')
            ->table('entry_stock_in_tbl')
            ->select(DB::raw("SUM(quantity) as total"))
            ->where('in_no', $get_inno)
            ->get();
            // dd($get_qty_before2);
            $totalitem = $get_qty_before2[0]->total;
            date_default_timezone_set("Asia/Jakarta");
            $date2 = Carbon::now();
            $time2 = Carbon::now()->format('H:i:s');
            $status2 = "EDIT";
            $in_no2 =  $get_inno;
            $userstaff2 = Auth::user()->FullName;
            $note2 = 'Wh:' . $get_types .'/'. 'Item:' . $get_item2 . '/'. 'Qty:' . $totalitem;
            DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
                'in_no' => $in_no2, 
                'date' => $date2,
                'time' => $time2,
                'status_change' => $status2,
                'user' => $userstaff2,
                'note' => $note2 
            ]);
            return response()->json([
                'success' => true
            ]);
        }
    
}
public function updateHeaderEditPageStin(Request $request, $in_no)
{
  
    $get_data_stin = DB::connection('db_tbs')
    ->table('entry_stock_in_tbl')
    ->where('in_no', $in_no)
    ->first();
    $count = DB::connection('db_tbs')
    ->table('entry_stock_in_tbl')
    ->where('in_no', $in_no)
    ->count();
    $get_types = $get_data_stin->types;
    $get_ref_no = $get_data_stin->ref_no;
    $period = $get_data_stin->period;
    $convert = Carbon::createFromFormat('Y-m',  $period)->format('Y');
    $convert2 = Carbon::createFromFormat('Y-m',  $period)->format('m');
    if(isset($get_types) == true && isset($get_ref_no) == true){
        $check =  DB::connection('db_tbs')
        ->table('stclose')
        ->whereYear('DATE','=',  $convert)
        ->whereMonth('DATE','=', $convert2)
        ->get();
        $msg = "Sudah di closing tidak bisa diedit";
        if ($check->isEmpty()) {
        $datastout = DB::connection('db_tbs')
        ->table('entry_stock_in_tbl')
        ->where('in_no', $in_no)
        ->update([
            'types' => $request->types !== '' ? $request->types : $get_data_stin->types,
            'ref_no' => $request->ref_no !== '' ? Str::upper($request->ref_no) : Str::upper($get_data_stin->ref_no),
            'remark_header'=> $request->remark_header !== '' ? Str::upper($request->remark_header) : Str::upper($get_data_stin->remark_header)
         ]);
        } else {
            return response()->json([
                'check'=> $check,
                'errors'=> $msg
            ]);
        }
       

    } 
    
    return response()->json([
        'success'=>true
    ]);

}
public function editDetail($id)
{
    $get_editdetail = StockInEntry::select('id_stin','itemcode','part_no',
        'descript','fac_unit','fac_qty','unit','quantity','remark_detail','factor')   
    ->where('id_stin','=', $id)
    ->first();
    return response()->json($get_editdetail);
}
public function updateDetailStin(Request $request, $id)
{
    // $check = StockOutEntry::where('itemcode', $request->input('itemcode'))->get();
    // $msg = "Data Sudah Pernah Diinput Bro...";
    // if ($check->isEmpty()) {
        $get_ = DB::connection('db_tbs')
        ->table('entry_stock_in_tbl')
        ->where('id_stin', '=', $id)
        ->first();
        $types = $get_->types;
        $in_no = $get_->in_no;

        $get_data = DB::connection('db_tbs')
        ->table('entry_stock_in_tbl')
        ->where('id_stin','=', $id)
        ->update([
            'itemcode' => $request->itemcode,
            'part_no'=> $request->part_no,
            'descript'=> $request->descript,
            'fac_unit'=> $request->fac_unit,
            'fac_qty'=> $request->fac_qty,
            'unit'=> $request->unit,
            'quantity'=> $request->quantity,
            'remark_detail'=> $request->remark_detail
        ]);  
        $get_qty_before = DB::connection('db_tbs')
                        ->table('entry_stock_in_tbl')
                        ->select(DB::raw("SUM(quantity) as total"))
                        ->where('in_no', $in_no)
                        ->get();
        $get_item = DB::connection('db_tbs')
                    ->table('entry_stock_in_tbl')
                    ->select('itemcode')
                    ->where('in_no', $in_no)
                    ->count();                    
        $total = $get_qty_before[0]->total;                    
        // $itemtotal =  $get_itemtotal+= $get_item;
        date_default_timezone_set("Asia/Jakarta");
        $date = Carbon::now();
        $time = Carbon::now()->format('H:i:s');
        $status = "EDIT";
        // $in_no =  $in_no;
        $userstaff = Auth::user()->FullName;
        $note = 'Wh :' . $types  . '/' . 'Item:'. $get_item .'/'. 'Qty:'. ' ' . $total;
        DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
            'in_no' => $in_no, 
            'date' => $date,
            'time' => $time,
            'status_change' => $status,
            'user' => $userstaff,
            'note' => $note 
        ]);          
        return response()->json([
            'success'=> true
        ]);  
    // } else if() {
    //     return response()->json([
    //         'error'=>$msg,
    //         'check'=> $check
    //     ]);
    // }


}
public function deleteDetailPageStin($id)
{
    $get_ = DB::connection('db_tbs')
    ->table('entry_stock_in_tbl')
    ->where('id_stin', '=', $id)
    ->first();
    $types = $get_->types;
    $in_no = $get_->in_no;
    // $get_data = DB::connection('db_tbs')
    //             ->table('entry_stock_in_tbl')
    //             ->where('id_stin', '=', $id)
    //             ->delete();
    $data = StockInEntry::find($id);
    $data->delete();
    $get_qty_before = DB::connection('db_tbs')
                        ->table('entry_stock_in_tbl')
                        ->select(DB::raw("SUM(quantity) as total"))
                        ->where('in_no', $in_no)
                        ->get();
    $get_item = DB::connection('db_tbs')
                ->table('entry_stock_in_tbl')
                ->select('itemcode')
                ->where('in_no', $in_no)
                ->count();                    
    $total = $get_qty_before[0]->total;                    
    date_default_timezone_set("Asia/Jakarta");
    $date = Carbon::now();
    $time = Carbon::now()->format('H:i:s');
    $status = "EDIT";
    $in_no =  $in_no;
    $userstaff = Auth::user()->FullName;
    $note = 'Wh :' . $types  . '/' . 'Item:'. $get_item .'/'. 'Qty:'. ' ' . $total;
    DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
        'in_no' => $in_no, 
        'date' => $date,
        'time' => $time,
        'status_change' => $status,
        'user' => $userstaff,
        'note' => $note 
    ]);          
                
    return response()->json([
        'success'=> true
    ]);
}
public function voidStinEntry(Request $request, $in_no)
{
    $get_tbl = \DB::connection('db_tbs')->table('entry_stock_in_tbl')
             ->where('in_no','=', $in_no)
             ->first();
    $periodCheck =  $get_tbl->period;        
    $convert = Carbon::createFromFormat('Y-m',  $periodCheck)->format('Y');
    $convert2 = Carbon::createFromFormat('Y-m',  $periodCheck)->format('m');
     
    DB::beginTransaction();
    try {
      $check =  DB::connection('db_tbs')
             ->table('stclose')
             ->whereYear('DATE','=',  $convert)
             ->whereMonth('DATE','=', $convert2)
             ->get();
        if ($check->isEmpty()) {
            $data = \DB::connection('db_tbs')->table('entry_stock_in_tbl')
                ->where('in_no','=', $in_no)
                ->update(['voided' => Carbon::now()]);
                $get_count = \DB::connection('db_tbs')->table('entry_stock_in_tbl')
                // ->select('out_no')
                ->where('in_no','=', $in_no)
                ->count();
                $select = DB::connection('db_tbs')
                            ->table('entry_stock_in_tbl')
                            // ->select('quantity','types')
                            ->where('in_no', '=', $in_no)
                            ->first();
                
                //INSERT LOG ACTIVITY
                // $get_data = $request->all();
                // $get_count_data = count($get_data['itemcode']);
                date_default_timezone_set("Asia/Jakarta");
                $date = Carbon::now();
                $time = Carbon::now()->format('H:i:s');
                $status = "VOID";
                $in_no =  $in_no;
                $userstaff = Auth::user()->FullName;
                // $note = 'Wh :' . $select->types . '/' . 'Item:'. $get_count .'/'. 'Qty:'. ' ' . $select->quantity;
                DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
                    'in_no' => $in_no, 
                    'date' => $date,
                    'time' => $time,
                    'status_change' => $status,
                    'user' => $userstaff,
                    'note' => $request->note !== '' ? $request->note : '' 
                ]);
                DB::commit();
                return response()->json([
                    'success' => true,
                ]);
        } else {
            return response()->json([
                'check'=> $check,
                'errors'=> "Data sudah diclosing tidak bisa di void"
            ]);
        }
       
    } catch (Exception $ex) {
        DB::rollback();
        return redirect()->back();
    }

}
public function reportStinEntry($in_no)
{
     $get_inno = base64_decode($in_no);
     $data = DB::connection('db_tbs')
             ->table('entry_stock_in_tbl')
             ->where('in_no', $get_inno)
             ->update(['printed' => Carbon::now()]);

     $data1 = DB::connection('db_tbs')
             ->table('entry_stock_in_tbl')
             ->where('in_no', $get_inno)
             ->get();

     $data2 = DB::connection('db_tbs')
             ->table('entry_stock_in_tbl')
             ->where('in_no', $get_inno)
             ->first();
     $count = DB::connection('db_tbs')
            ->table('entry_stock_in_tbl')
            ->where('in_no', $get_inno)
            ->count();
    date_default_timezone_set("Asia/Jakarta");
    $date = Carbon::now();
    $time = Carbon::now()->format('H:i:s');
    $status = "PRINTED";
    $in_no =  $get_inno;
    $userstaff = Auth::user()->FullName;
    // $note = 'Wh :' . $data2->types . '/' . 'Item:'. $count .'/'. 'Qty:'. ' ' . $data2->quantity;
    DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
        'in_no' => $in_no, 
        'date' => $date,
        'time' => $time,
        'status_change' => $status,
        'user' => $userstaff,
        'note' => '' 
    ]);
    $pdf = PDF::loadView('tms.warehouse.stock-in-entry.report.report', ['data1' => $data1, 'data2' => $data2]);
    return $pdf->stream();
}

public function postStinEntry(Request $request, $in_no)
{
   
    DB::beginTransaction();
    try {
        $get_data = \DB::connection('db_tbs')
                ->table('entry_stock_in_tbl')
                ->where('in_no', $in_no)
                ->first();
        // $get_posted =  $data['posted'];
        $period = $get_data->period;
        $convert1 = Carbon::createFromFormat('Y-m',  $period)->format('Y');
        $convert2 = Carbon::createFromFormat('Y-m',  $period)->format('m');
        $check =  DB::connection('db_tbs')
        ->table('stclose')
        ->whereYear('DATE','=',  $convert1)
        ->whereMonth('DATE','=', $convert2)
        ->get();
        $msg = "Sudah di closing tidak bisa di UNPOST period :";
        $get_posted = $get_data->posted;
        if ($get_posted != null) {
            if ($check->isEmpty()) {
                $unpost = \DB::connection('db_tbs')
                ->table('entry_stock_in_tbl')
                ->where('in_no', $in_no)
                ->update(['posted' => NULL]);
           // INSERT LOG ACTIVITY
                date_default_timezone_set("Asia/Jakarta");
                $date = Carbon::now();
                $time = Carbon::now()->format('H:i:s');
                $status = "UN-POST";
                $in_no =  $in_no;
                $userstaff = Auth::user()->FullName;
                $note = $request->note;
                DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
                    'in_no' => $in_no, 
                    'date' => $date,
                    'time' => $time,
                    'status_change' => $status,
                    'user' => $userstaff,
                    'note' => $note 
                ]);            
            } else {
                return response()->json([
                    'check'=> $check,
                    'errors'=> $msg . $period
                ]);
            }
          
        } else {
            $convertPost1 = Carbon::createFromFormat('Y-m',  $period)->format('Y');
            $convertPost2 = Carbon::createFromFormat('Y-m',  $period)->format('m');
            $check2 =  DB::connection('db_tbs')
            ->table('stclose')
            ->whereYear('DATE','=',  $convertPost1)
            ->whereMonth('DATE','=', $convertPost2)
            ->get();
            if ($check2->isEmpty()) {
                $post = \DB::connection('db_tbs')
                ->table('entry_stock_in_tbl')
                ->where('in_no', $in_no)
                ->update(['posted' => Carbon::now()]);
    
                date_default_timezone_set("Asia/Jakarta");
                $date = Carbon::now();
                $time = Carbon::now()->format('H:i:s');
                $status = "POST";
                $in_no =  $in_no;
                $userstaff = Auth::user()->FullName;
                $note = $request->note;
                DB::connection('db_tbs')->table('entry_stock_in_log_tbl')->insert([
                    'in_no' => $in_no, 
                    'date' => $date,
                    'time' => $time,
                    'status_change' => $status,
                    'user' => $userstaff,
                    'note' => $note 
                ]);         
            } else {
                return response()->json([
                    'check'=> $check2,
                    'errors'=> "Data sudah diclosing, tidak bisa dipost!, period:" . $period
                ]);
            }
             
        }
 
        
        DB::commit();
        return response()->json([
            'success' => true,
        ]);
    } catch (Exception $ex) {
        DB::rollback();
        return redirect()->back();
    }
}
public function logStinEntry($in_no)
{
    $viewLog =  DB::connection('db_tbs')
    ->table('entry_stock_in_log_tbl')
    ->where('in_no','=', $in_no)
    ->get();
    echo json_encode($viewLog);
    exit;
}
public function checkStClose($period){
    $get_period = $period;
    $convert = Carbon::createFromFormat('Y-m',  $get_period)->format('Y');
    $convert2 = Carbon::createFromFormat('Y-m',  $get_period)->format('m');
    $checkStClose = DB::connection('db_tbs')
    ->table('stclose')
    ->whereYear('DATE','=',  $convert)
    ->whereMonth('DATE','=', $convert2)
    ->get();
    if ($checkStClose->isEmpty()) {
      echo 'Silahkan Input';
    } else {
        $msg = "Sudah diclosing tidak bisa input";
        return response()->json([
            'msg'=>$msg
        ]);
    }
}

// public function checkStClose($period){
//     $get_period = $period;
//     $convert = Carbon::createFromFormat('Y-m',  $get_period)->format('Y');
//     $convert2 = Carbon::createFromFormat('Y-m',  $get_period)->format('m');
//     $checkStClose = DB::connection('db_tbs')
//     ->table('stclose')
//     ->whereYear('DATE','=',  $convert)
//     ->whereMonth('DATE','=', $convert2)
//     ->get();
//     if ($checkStClose->isEmpty()) {
//       echo 'Silahkan Input';
//     } else {
//         $msg = "Sudah diclosing tidak bisa input";
//         return response()->json([
//             'msg'=>$msg
//         ]);
//     }
// }

}
