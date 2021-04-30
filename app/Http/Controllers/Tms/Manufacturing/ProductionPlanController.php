<?php

namespace App\Http\Controllers\Tms\Manufacturing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Oee\db_processname_tbl;
use App\Models\Oee\db_machinenumber_tbl;
use App\Models\Dbtbs\entry_production_scheduler_detail_tbl;
use App\Models\StoredProcedure\proc_ProductionPlan;

class ProductionPlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('tms.manufacturing.production-plan.index');
    }

    public function summaryLoadingCapacityPerMonth(){
        return view('tms.manufacturing.production-plan.summary-loadingcapacity-permonth');
    }

    public function summaryLoadingCapacityPerDate(){
        return view('tms.manufacturing.production-plan.summary-loadingcapacity-perdate');
    }

    public function summaryLoadingCapacityPerMachine(){
        return view('tms.manufacturing.production-plan.summary-loadingcapacity-permachine');
    }

    public function detailLoadingCapacityPerDate(){
        return view('tms.manufacturing.production-plan.detail-loadingcapacity-perdate');
    }

    public function detailLoadingCapacityPerMachine()
    {
        return view('tms.manufacturing.production-plan.detail-loadingcapacity-permachine');
    }


    public function get_datSummaryLoadingCapacityPerMonth(Request $request){
        $flag = $request->input('flag');

        if ($flag=='get_cmbProdProcess'){
            $prod_process = db_processname_tbl::Production_process();
            echo json_encode($prod_process);
            exit;

        } elseif ($flag=='get_ctPlanSummaryPerMonth'){
            $period = $request->input('period');
            $process = $request->input('process');
            $offset = $request->input('offset');
            $limit = $request->input('limit');

            $plan_summary = proc_ProductionPlan::Plan_SummaryPerMonth($period, $process, $offset, $limit);
            echo json_encode($plan_summary);
            exit;

        } elseif ($flag=='get_ctPlanSummaryPerMonthByOp'){
            $period = $request->input('period');
            $process = $request->input('process');
            $offset = $request->input('offset');
            $limit = $request->input('limit');

            $plan_summary = proc_ProductionPlan::Plan_SummaryPerMonthByOp($period, $process, $offset, $limit);
            echo json_encode($plan_summary);
            exit;
        }
    }

    public function get_datSummaryLoadingCapacityPerDate(Request $request){
        $flag = $request->input('flag');

        if ($flag=='get_cmbProdProcess'){
            $prod_process = db_processname_tbl::Production_process();
            echo json_encode($prod_process);
            exit;

        } elseif($flag=='get_ctPlanSummaryPerDate'){
            $period = $request->input('period');
            $process = $request->input('process');
            $shift = $request->input('shift');

            $plan_summary = proc_ProductionPlan::Plan_SummaryPerDate($period, $process, $shift);
            echo json_encode($plan_summary);
            exit;
        }
    }

    public function get_datSummaryLoadingCapacityPerMachine(Request $request){
        $flag = $request->input('flag');

        if ($flag=='get_cmbProdProcess'){
            $prod_process = db_processname_tbl::Production_process();
            echo json_encode($prod_process);
            exit;

        } elseif ($flag=='get_cmbMachineNumber'){
            $prod_process = $request->input('prod_process');
            $flag_machine = $request->input('flag_machine');

            if ($flag_machine==1){
                $machine_number['data'] = db_machinenumber_tbl::MachineNumberOnProdProcess($prod_process);
            } elseif ($flag_machine==0){
                $machine_number['data'] = db_machinenumber_tbl::MachineNumber();
            }

            echo json_encode($machine_number);
            exit;

        } elseif ($flag=='get_ctPlanSummaryPerMachine'){
            $period = $request->input('period');
            $mach_number = $request->input('mach_number');
            $shift = $request->input('shift');

            $plan_summary = proc_ProductionPlan::Plan_SummaryPerMachine($period, $mach_number, $shift);
            echo json_encode($plan_summary);
            exit;

        } elseif ($flag=='get_ctPlanSummaryPerMachineByOp'){
            $process = $request->input('process');
            $period = $request->input('period');
            $machine = $request->input('machine');
            $plan_date = $request->input('plan_date');
            $flag_machine = $request->input('switch');

            $plan_summary = proc_ProductionPlan::PlanDetailPerMachineByOp($process, $period, $machine, $plan_date, $flag_machine);
            echo json_encode($plan_summary);
            exit;
        }
    }


    public function get_datDetailLoadingCapacityPerDate(Request $request){
        $flag = $request->input('flag');

        if ($flag=='get_cmbProdProcess'){
            $prod_process = db_processname_tbl::Production_process();
            echo json_encode($prod_process);
            exit;

        } elseif ($flag=='get_dtPlanningDetailPerDate'){
            $process = $request->input('process');
            $period = $request->input('period');
            $machine = $request->input('machine');
            $plan_date = $request->input('plan_date');
            $shift = $request->input('shift');
            $flag_date = $request->input('flag_date');

            $planDetailPerDate = proc_ProductionPlan::PlanDetailPerDate($process, $period, $machine, $plan_date, $shift, $flag_date);
            return Datatables::of($planDetailPerDate)
                ->make(true);
        }
    }


}
