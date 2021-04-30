<?php

namespace App\Models\StoredProcedure;

use Illuminate\Support\Facades\DB;

class proc_RawMaterial
{
    //Connect to db_tbs
    protected $connection = 'db_tbs';

    /*
    |+++++++++++++++++++++++++++++++++++++++++++++++++++++
    | 1. proc_rawMaterial_setupSupplierMapping_get_data
    | 2. proc_rawMaterial_setupSupplierMapping_post_data
    | 3. proc_rawMaterial_forecastNote_get_data
    | 4. proc_rawMaterial_forecastNote_post_data
    | 5. proc_rawMaterial_setupSupplierReport_get_data
    | 6. proc_rawMaterial_setupSupplierReport_post_data
    | 7. proc_rawMaterial_referenceBom_get_data
    |+++++++++++++++++++++++++++++++++++++++++++++++++++++
    */

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    // 1. proc_rawMaterial_setupSupplierMapping_get_data
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function MappedRawMaterialWithSupplier(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(1));
    }

    public static function MasterItemRawMaterial(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(2));
    }

    public static function MasterSupplierRawMaterial(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(3));
    }

    public static function MappedSupplierRawMaterial(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(4));
    }

    public static function DoubleMappingFlag(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(5));
    }

    public static function DoubleMappingItemCode(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(6));
    }

    public static function PctgErrorDistributionMappingItemCode(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(7));
    }

    public static function PctgErrorDistributionMappingFlag(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_get_data(?)',array(8));
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    // 2. proc_rawMaterial_setupSupplierMapping_post_data
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function PostSupplierDistribution($flag, $item_code, $supplier, $distribution, $by_user, $by_type, $id){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierMapping_post_data(?,?,?,?,?,?,?)',array($flag, $id, $item_code, $supplier, $distribution, $by_user, $by_type));
    }

    //++++++++++++++++++++++++++++++++++++++++++++++
    // 3. proc_rawMaterial_forecastNote_get_data
    //++++++++++++++++++++++++++++++++++++++++++++++
    public static function ForecastOpRawMaterial($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(1, $vend_code, $period, $model));
    }

    public static function ForecastVerNumber($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(2, $vend_code, $period, $model));
    }

    public static function ViewForecastNoteDetail($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(3, $vend_code, $period, $model));
    }

    public static function ViewForecastNoteHeader($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(4, $vend_code, $period, $model));
    }

    public static function DashboardForecastNote($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(5, $vend_code, $period, $model));
    }

    public static function ApproveForecastNote($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(6, $vend_code, $period, $model));
    }

    public static function ReportForecastNoteHeader($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(7, $vend_code, $period, $model));
    }

    public static function ReportForecastNoteParameter($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(8, $vend_code, $period, $model));
    }

    public static function ReportForecastNoteVerPeriod($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(9, $vend_code, $period, $model));
    }

    public static function ReportForecastNoteDetail($vend_code, $period, $model = null){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(10, $vend_code, $period, $model));
    }

    public static function ReportForecastNoteDetailModel($vend_code, $period){
        $model = null;
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_get_data(?,?,?,?)',array(11, $vend_code, $period, $model));
    }

    //++++++++++++++++++++++++++++++++++++++++++++
    // 4. proc_rawMaterial_forecastNote_post_data
    //++++++++++++++++++++++++++++++++++++++++++++
    public static function PostForecastNote($flag, $id, $vend_code, $period, $ver_no, $ver_date, $item_code,
                                            $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty,
                                            $sc_nm5_qty, $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate,
                                            $model){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_forecastNote_post_data(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                array($flag, $id, $vend_code, $period, $ver_no, $ver_date, $item_code,
                                      $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty,
                                      $sc_nm5_qty, $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate,
                                      $model));
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    // 5. proc_rawMaterial_setupSupplierReport_get_data
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function ReportSupplierData(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierReport_get_data(?)',array(1));
    }

    public static function ReportInhouseData(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierReport_get_data(?)',array(2));
    }

    public static function ReportRawMaterialModelClusterization(){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierReport_get_data(?)',array(3));
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    // 6. proc_rawMaterial_setupSupplierReport_post_data
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function PostSetupSupplierReportParameter($flag, $ld_number, $prepared,
                                                            $checked, $approved, $by_user, $by_type, $id,
                                                            $start_date, $end_date){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierReport_post_parameter_data(?,?,?,?,?,?,?,?,?,?)',
                                array($flag, $ld_number, $prepared, $checked, $approved, $by_user, $by_type, $id,
                                      $start_date, $end_date));
    }

    public static function PostSetupSupplierReportClusterization($flag, $supplier, $by_user,
                                                                 $by_type, $id, $edit_createdBy, $edit_createdDate){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_setupSupplierReport_post_clusterization_data(?,?,?,?,?,?,?)',
                               array($flag, $supplier, $by_user, $by_type, $id, $edit_createdBy, $edit_createdDate));
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++
    // 7. proc_rawMaterial_referenceBom_get_data
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function GetInitReferenceBom($flag, $keyword){
        return $query = DB::connection('db_tbs')
                      ->select('call proc_rawMaterial_referenceBom_get_data(?,?)',
                               array($flag, $keyword));
    }

}
