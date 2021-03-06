<?php

namespace App\Models\Dbtbs;

use Illuminate\Database\Eloquent\Model;
use DB;
use DataTables;
use App\Models\Dbtbs\Sys_Number;
// use Illuminate\Database\Eloquent\SoftDeletes;
class StockInEntry extends Model
{
    // use SoftDeletes;
    protected $connection = 'db_tbs';
    protected $table = 'entry_stock_in_tbl';
    protected $fillable = [ 
        'in_no','ref_no','itemcode','part_no','descript','unit','quantity','cost','glinv',
        'types','branch','warehouse','fac_unit','fac_qty',
        'factor','remark_header','remark_detail','period','vperiod','staff','posted','printed',
        'voided','created_by','created_date',
        'updated_by','updated_date'
      ];
    protected $primaryKey = 'id_stin';
    public $timestamps = false;
    
    // protected $dates = ['deleted_at'];

    public function getStinNo()
    {
        // $get_sys_number1 = DB::connection('db_tbs')
        //              ->table('sys_number')
        //              ->select('contents')
        //              ->where('LABEL','=', 'STOCK OUT NUMBER')
        //              ->first();


        // $cek_stinno = $get_sys_number1->contents + 1;
        // $cek_data_stockout = StockOutEntry::where('in_no', $cek_stinno)->select('in_no')->get();

        // if ($cek_data_stockout->isEmpty()) {
        //         $in_no = $cek_stinno;
        //         return $in_no;
        // } else {
        //     do {
        //         $cek_stinno++;
        //         $cek_data_stockout = StockOutEntry::where('in_no', $cek_stinno)->select('in_no')->get();
        //     } while (!$cek_data_stockout->isEmpty());
        //         $in_no = $cek_stinno;
        //         return $in_no;
        // }
        $reference = Sys_Number::select(DB::raw('concat(right(year(NOW()),2),DATE_FORMAT(NOW(),"%m")) as ref'))
        ->limit('1')
        ->get();
        $stin_sysno = Sys_number::where('label','STOCK IN NUMBER')
        ->select('contents')
        ->get();
        $a = substr($stin_sysno[0]->contents,0,4); //4 digit do no dari sys number ex: 2007 | 20 : 2 Digit Terakhir dari Tahun 2020 | 07 " 2 digit dari Bulan pada tahun tersebut
        $b = $reference[0]->ref; //4 digit dari datetime diambil sebagai validasi 4 digit no dari sys number ex: 2007 | 20 : 2 Digit Terakhir dari Tahun 2020 | 07 " 2 digit dari Bulan pada tahun tersebut
        if ($a == $b){ //Jika 4 digit dari sys_number & date sama
            //do no dari sysnumber ditambahkan 1
             $cek_stinno = $stin_sysno[0]->contents + 1;
            //kemudian di cek di tabel do hdr
             $cek_stouttbl = DB::connection('db_tbs')->table('entry_stock_in_tbl')->where('in_no',$cek_stinno)
             ->select(['in_no'])
             ->get();  
            if ($cek_stouttbl->isEmpty()){ //jika result dari cek_stouttbl null(kosong)
                $in_no = $cek_stinno;
                return $in_no;
            }else{
                do{
                    $cek_stinno++;
                    $cek_stouttbl = DB::connection('db_tbs')->table('entry_stock_in_tbl')->where('in_no',$cek_stinno)
                    ->select(['in_no'])
                    ->get();           
                }while (!$cek_stouttbl->isEmpty()); //lopping sampai tabel do hdr mendapatkan value null
                $in_no = $cek_stinno;
                return $in_no;
            }
        } else {
            //buat baru do no dengan ref ditambah 0001 dan cek di do no
            $cek_stinno  = $b;
            $cek_stinno  .= '0001';
            $cek_stouttbl = DB::connection('db_tbs')->table('entry_stock_in_tbl')->where('in_no',$cek_stinno)
            ->select(['in_no'])
            ->get();  
            if ($cek_stouttbl->isEmpty()){
                $in_no = $cek_stinno;
                return $in_no;
            }else{
                do{
                    $cek_stinno++;
                    $cek_stouttbl = DB::connection('db_tbs')->table('entry_stock_in_tbl')->where('in_no',$cek_stinno)
                    ->select(['in_no'])
                    ->get();           
                }while (!$cek_stouttbl->isEmpty());
                $in_no = $cek_stinno;
                return $in_no;
            }
        }  
  
    }
    // public function validationItemSame()
    // {
    //             $cek = DB::connection('db_tbs')
    //                  ->table('entry_stock_out_tbl')
    //                  ->select('itemcode')->first();
    //            $cek_itemcode =  DB::connection('db_tbs')
    //                             ->table('entry_stock_out_tbl')
    //                             ->select('itemcode')
    //                             ->where('itemcode', $cek->itemcode)->get();
    //             if ($cek_itemcode) {
    //                   # code...
    //               }  
    // }
    // public function editDetail($in_no)
    // {
    //     // $StoutHeader   = StockOutEntry::where('in_no', $id)->first();
    //     // $stoutDetail = $StoutHeader->in_no;
    //     $StoutEditDetail   = StockOutEntry::select('id_stout',
    //         'in_no','refs_no','itemcode','part_no','descript','fac_unit','fac_qty','factor',
    //         'unit','quantity','period','staff','types','operator','written','printed','voided',
    //         'posted','remark','po_no')   
    //     ->where('in_no', '=', $in_no)
    //     ->first();
  
    //     return $StoutEditDetail;
    //     // return Datatables::of($StoutEditDetail)
    //     //     ->addColumn('action', function($data){
    //     //         return '<a href="/warehouse/stock_out_entry/'. $data->id_stout .'/stock_out_entry_edit" class="btn btn-info btn-xs">tes</a>';
    //     //     })->rawColumns(['action'])
    //     //     ->make(true);     
    // }


    
}
