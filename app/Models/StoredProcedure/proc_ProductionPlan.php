<?php

namespace App\Models\StoredProcedure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class proc_ProductionPlan extends Model
{
    //Connect to db_tbs
    protected $connection = 'db_tbs';


    public static function scopePlanDetailPerMachine($query, $process, $period, $machine, $plan_date, $shift, $flag){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanDetailPerMachine(?,?,?,?,?,?)',array($process, $period, $machine, $plan_date, $shift, $flag));
    }

    public static function scopePlanDetailPerMachineByOp($query, $process, $period, $machine, $plan_date, $flag){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanDetailPerMachineByOp(?,?,?,?,?)',array($process, $period, $machine, $plan_date, $flag));
    }

    public static function scopePlanDetailPerDate($query, $process, $period, $machine, $plan_date, $shift, $flag){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanDetailPerDate(?,?,?,?,?,?)',array($process, $period, $machine, $plan_date, $shift, $flag));
    }

    public static function scopePlan_SummaryPerMachine($query, $period, $machine, $shift){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanSummaryPerMachine(?,?,?)',array($period,$machine,$shift));
    }

    public static function scopePlan_SummaryPerDate($query, $period, $process, $shift){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanSummaryPerDate(?,?,?)',array($period,$process,$shift));
    }

    public static function scopePlan_SummaryPerMonth($query, $period, $process, $offset, $limit){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanSummaryPerMonth(?,?,?,?)',array($period,$process,$offset, $limit));
    }

    public static function scopePlan_SummaryPerMonthByOp($query, $period, $process, $offset, $limit){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_PlanSummaryPerMonthByOp(?,?,?,?)',array($period,$process,$offset, $limit));
    }
}
