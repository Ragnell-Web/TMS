<?php

namespace App\Models\Dbtbs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class entry_production_scheduler_detail_tbl extends Model
{
    //Connect to db_tbs
    protected $connection = 'db_tbs';
    //Define table
    protected $table = 'entry_production_scheduler_detail_tbl';

    public static function scopePlanningDetailPerMachine($query, $period, $mach_number, $shift){
        $select = array('date2', 'shift', 'item_code', 'prod_code', 'qty_plan', 'planning_status');

        if ($shift == 0){
            return $query = DB::connection('db_tbs')
                        ->table('entry_production_scheduler_detail_tbl')
                        ->select($select)
                        ->where('status','ACTIVE')
                        ->where('machine_number',$mach_number)
                        ->where('period',$period)
                        ->orderByRaw("date2 ASC, shift ASC")
                        ->get();
        }else{
            return $query = DB::connection('db_tbs')
                        ->table('entry_production_scheduler_detail_tbl')
                        ->select($select)
                        ->where('status','ACTIVE')
                        ->where('machine_number',$mach_number)
                        ->where('period',$period)
                        ->where('shift',$shift)
                        ->orderByRaw("date2 ASC, shift ASC")
                        ->get();
        }
    }
}

