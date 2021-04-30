<?php

namespace App\Models\Oee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class db_machinenumber_tbl extends Model
{
    //Connect to db_tbs
    protected $connection = 'oee';
    //Define table
    protected $table = 'db_machinenumber_tbl';

    public static function scopeMachineNumberOnProdProcess($query, $prod_process){
        $select = array('machine_number', 'machine_type', 'machine_capacity', 'production_line');

        return $query = DB::connection('oee')
                      ->table('db_machinenumber_tbl')
                      ->select($select)
                      ->where('status','ACTIVE')
                      ->where('production_process',$prod_process)
                      ->orderBy('machine_number', 'asc')
                      ->get();
    }

    public static function scopeMachineNumber($query){
        $select = array('machine_number', 'machine_type', 'machine_capacity', 'production_line');

        return $query = DB::connection('oee')
                      ->table('db_machinenumber_tbl')
                      ->select($select)
                      ->where('status','ACTIVE')
                      ->orderBy('machine_number', 'asc')
                      ->get();
    }
}

