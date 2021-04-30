<?php

namespace App\Models\Oee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class db_processname_tbl extends Model
{
    //Connect to db_tbs
    protected $connection = 'oee';
    //Define table
    protected $table = 'db_processname_tbl';

    public static function scopeProduction_Process($query){
        $select = array('production_process');

        return $query = DB::connection('oee')
                      ->table('db_processname_tbl')
                      ->select($select)
                      ->where('status','ACTIVE')
                      ->where('routing','INHOUSE')
                      ->orderBy('production_process', 'asc')
                      ->get();
     }
}
