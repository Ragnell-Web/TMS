<?php

namespace App\Http\Controllers\TMS\Manufacturing;

// Laravel Libraries
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

// Classes
use App\Classes\ButtonBuilder As ButtonBuilder;
use App\Exports\RawMaterialForecastNoteExport AS RawMaterialForecastNoteExport;

// Controllers
use App\Http\Controllers\RolePermissionController As RolePermissionControl;

// Models
use App\Models\User_Role As UserRole;
use App\Models\dbtbs\Item As Item;
use App\Models\dbtbs\Vendor As Vendor;
use App\Models\StoredProcedure\proc_RawMaterial As RawMaterial;

class RawMaterialController extends Controller
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

    //+++++++++++++++++++++++++++
    // VIEW Function
    //+++++++++++++++++++++++++++

    public function index(){
        return view('tms.manufacturing.raw-material.index');
    }

    public function setupSupplierDistribution(){
        $ActionButton = '';
        $WarningButton1 = '';
        $WarningButton2 = '';

        $UserID     = Auth::user()->id;
        $UserRole   = UserRole::where('ekanban_user_id', $UserID)->first();
        $RoleID     = $UserRole->role_id;
        $ControlAccess  = RolePermissionControl::CheckPermission($RoleID, 'control_setupSupplierDistributionRawMaterial'); // $PERMISSION_KEY
        if($ControlAccess){
            $ActionButton = ButtonBuilder::Build('MAIN', 'ADD', 'add-btn', 'ti-plus', 'Add Mapping Supplier');

            $response = 0;
            $response = RawMaterial::DoubleMappingFlag();
            if ($response){
                $WarningButton1 = ButtonBuilder::Build('MAIN', 'VIEW', 'viewDoubleMapping-btn', 'ti-loop', 'WARNING - Double Mapping');
            }
            $response = 0;
            $response = RawMaterial::PctgErrorDistributionMappingFlag();
            if ($response){
                $WarningButton2 = ButtonBuilder::Build('MAIN', 'VIEW', 'viewErrorDistributionMapping-btn', 'ti-layout-list-post', 'WARNING - %Distribution Mapping');
            }
        }
        $data = [
            'ActionButton' => $ActionButton,
            'WarningButton1' => $WarningButton1,
            'WarningButton2' => $WarningButton2,
        ];

        return view('tms.manufacturing.raw-material.setup-supplier-distribution')->with($data);

    }

    public function setupLot(){
        return view('tms.manufacturing.raw-material.setup-lot');
    }

    public function setupSupplierReport(){
        $AddButton = '';

        $UserID     = Auth::user()->id;
        $UserRole   = UserRole::where('ekanban_user_id', $UserID)->first();
        $RoleID     = $UserRole->role_id;
        $ControlAccess  = RolePermissionControl::CheckPermission($RoleID, 'control_forecastNoteRawMaterial'); // $PERMISSION_KEY

        if($ControlAccess){
            $AddButton = ButtonBuilder::Build('MAIN', '', 'create-btn', 'ti-blackboard', 'Add Supplier');
        }
        $data = [
            'AddButton' => $AddButton,
        ];

        return view('tms.manufacturing.raw-material.setup-supplier-report')->with($data);
    }

    public function forecastNote(){
        $ViewButton = '';
        $CreateButton = '';
        $DeleteButton = '';
        $PrintButton = '';
        $ExportButton = '';
        $ApproveButton = '';
        $UnApproveButton = '';

        $UserID     = Auth::user()->id;
        $UserRole   = UserRole::where('ekanban_user_id', $UserID)->first();
        $RoleID     = $UserRole->role_id;
        $ViewAccess  = RolePermissionControl::CheckPermission($RoleID, 'view_forecastNoteRawMaterial');  // $PERMISSION_KEY
        $ControlAccess  = RolePermissionControl::CheckPermission($RoleID, 'control_forecastNoteRawMaterial'); // $PERMISSION_KEY
        $ApproveAccess = RolePermissionControl::CheckPermission($RoleID, 'approve_forecastNoteRawMaterial'); // $PERMISSION_KEY
        if($ViewAccess){
            $ViewButton = ButtonBuilder::Build('MAIN', 'VIEW', 'view-btn', 'ti-eye', 'View');
            $PrintButton = ButtonBuilder::Build('MAIN', 'VIEW', 'print-btn', 'ti-printer', 'Print');
            $ExportButton = ButtonBuilder::Build('MAIN', 'VIEW', 'export-btn', 'ti-export', 'Export');
        }
        if($ControlAccess){
            $CreateButton = ButtonBuilder::Build('MAIN', 'ADD', 'create-btn', 'ti-blackboard', 'Create');
            $DeleteButton = ButtonBuilder::Build('MAIN', 'DELETE', 'delete-btn', 'ti-trash', 'Delete', '#');
        }
        if($ApproveAccess){
            $ApproveButton = ButtonBuilder::Build('MAIN', 'TEMPLATE', 'approve-btn', 'ti-pin2', 'Approve');
            $UnApproveButton = ButtonBuilder::Build('MAIN', 'DELETE', 'unapprove-btn', 'ti-pin-alt', 'Un-Approve');
        }
        $data = [
            'ViewButton' => $ViewButton,
            'CreateButton' => $CreateButton,
            'DeleteButton' => $DeleteButton,
            'PrintButton' => $PrintButton,
            'ExportButton' => $ExportButton,
            'ApproveButton' => $ApproveButton,
            'UnApproveButton' => $UnApproveButton,
        ];

        return view('tms.manufacturing.raw-material.forecast-note')->with($data);
    }

    public function referenceBom(){
        return view('tms.manufacturing.raw-material.reference-bom');
    }

    //+++++++++++++++++++++++++++
    // GET Function
    //+++++++++++++++++++++++++++

    public function get_datReferenceBom($flag, $keyword){
        if($flag=="SEARCH"){
            $txtData['data'] = RawMaterial::GetInitReferenceBom($flag, $keyword);
            echo json_encode($txtData);
            exit;
        }
    }

    public function get_datSupplierReport($flag){
        $UserID     = Auth::user()->id;
        $UserRole   = UserRole::where('ekanban_user_id', $UserID)->first();
        $RoleID     = $UserRole->role_id;
        $ControlAccess  = RolePermissionControl::CheckPermission($RoleID, 'control_setupSupplierReportRawMaterial');

        if($flag == 1){
            $datatable = RawMaterial::ReportSupplierData();
            //dd($datatable);
            return Datatables::of($datatable)
                ->addColumn('action', function ($data) use ($ControlAccess){
                    $ActionButton = '';
                    if($ControlAccess){
                        $ActionButton = $ActionButton.ButtonBuilder::Build('DATATABLE', 'EDIT', 'edit-btn', 'fa fa-edit', 'Edit', '#', "row-vendor_code='$data->vendor_code' row-contact='$data->contact' row-phone='$data->phone' row-fax='$data->fax'");
                    }
                    return $ActionButton;
                })
                ->make(true);
        } elseif($flag == 2){
            $datatable = RawMaterial::ReportInhouseData();
            return Datatables::of($datatable)
                ->addColumn('action', function ($data) use ($ControlAccess){
                    $ActionButton = '';
                    if($ControlAccess){
                        $ActionButton = $ActionButton.ButtonBuilder::Build('DATATABLE', 'EDIT', 'edit-btn', 'fa fa-edit', 'Edit', '#', "row-id='$data->id' row-ld='$data->report_ld_number' row-prepared='$data->report_prepared_by' row-approved='$data->report_approved_by' row-checked='$data->report_checked_by' row-start_date='$data->report_start_date' row-end_date='$data->report_end_date'");
                    }
                    return $ActionButton;
                })
                ->make(true);
        } elseif($flag == 3){
            $datatable = RawMaterial::ReportRawMaterialModelClusterization();
            return Datatables::of($datatable)
                ->addColumn('action', function ($data) use ($ControlAccess){
                    $ActionButton = '';
                    $DeleteButton = '';
                    if($ControlAccess){
                        $ActionButton = $ActionButton.ButtonBuilder::Build('DATATABLE', 'EDIT', 'edit-btn', 'fa fa-edit', 'Edit', '#', "row-id='$data->id' row-vendor_code='$data->vendor_code'");
                        $ActionButton = $ActionButton.ButtonBuilder::Build('DATATABLE', 'DELETE', 'delete-btn', 'ti-trash', 'Delete', '#', "row-id='$data->id' row-vendor_code='$data->vendor_code'");
                    }
                    return $ActionButton;
                })
                ->make(true);
        }
    }

    public function get_datForecastNote($vend_code, $period, $flag){
        if($flag=='VIEW_HEADER'){
            $txtData['data'] = RawMaterial::ViewForecastNoteHeader($vend_code, $period);
            echo json_encode($txtData);
            exit;

        } elseif($flag=='VIEW_DETAIL'){
            $datatable = RawMaterial::ViewForecastNoteDetail($vend_code, $period);
            return Datatables::of($datatable)
                ->make(true);

        } elseif($flag=='DASH_DETAIL'){
            $datatable = RawMaterial::DashboardForecastNote($vend_code, $period);
            return Datatables::of($datatable)
                ->make(true);

        } elseif($flag=='APPROVAL'){
            $txtData['data'] = RawMaterial::ApproveForecastNote($vend_code, $period);
            echo json_encode($txtData);
            exit;

        } elseif($flag=='REPORT_FORECAST_NOTE_PRINT'){
            $model_type = RawMaterial::ReportForecastNoteDetailModel($vend_code, $period);

            foreach($model_type AS $type){
                ${'data'.$type->model} = RawMaterial::ReportForecastNoteDetail($vend_code, $period, $type->model);
                $txtData['data'.$type->model] = ${'data'.$type->model};
            }

            $output    = [
                'header'        => RawMaterial::ReportForecastNoteHeader($vend_code, $period),
                'parameter'     => RawMaterial::ReportForecastNoteParameter($vend_code, $period),
                'ver_period'    => RawMaterial::ReportForecastNoteVerPeriod($vend_code, $period),
                'detail'        => $txtData,
                'detail_model'  => RawMaterial::ReportForecastNoteDetailModel($vend_code, $period),
            ];

            $pdf = PDF::loadview('tms.manufacturing.raw-material.forecast-note-report', $output)
                       ->setPaper('a4', 'landscape');
            return $pdf->stream('VENDOR - ' . $vend_code);

        } elseif($flag=='EXPORT_FORECAST_NOTE_EXCEL'){

            // Assign Class to Generate Excel Report
            $export = new RawMaterialForecastNoteExport;
            $export->setVendorCode($vend_code);
            $export->setPeriod($period);

            // Generate Output
            return Excel::download($export, 'rawMaterial_forecastNote_report.xlsx');
        } elseif($flag=='FORECAST_NOTE_VER_NO'){
            $txtData['data'] = RawMaterial::ForecastVerNumber($vend_code, $period);
            echo json_encode($txtData);
            exit;

        } elseif($flag=='FORECAST_NOTE_dtOP'){
            $datatable = RawMaterial::ForecastOpRawMaterial($vend_code, $period);
            return Datatables::of($datatable)
                ->make(true);

        } elseif($flag=='cmbPeriodRawMaterial'){
            $currentdate = Carbon::now()->addMonths(1);
            $dropdown['data'][0] = (object)array('period' => $currentdate->format('Y-m'));

            for($i = 0; $i < 12; $i++){
                $currentdate = Carbon::now()->addMonths(-$i);
                $dropdown['data'][$i+1] = (object)array('period' => $currentdate->format('Y-m'));
            }

            echo json_encode($dropdown);
            exit;
        } elseif($flag=='cmbMappedSupplierRawMaterial'){
            $dropdown['data'] = RawMaterial::MappedSupplierRawMaterial();
            echo json_encode($dropdown);
            exit;
        }
    }

    public function get_datSupplierDistribution(Request $request, $flag, $itemcode, $vendcode){
        if ($flag==1){
            $UserID     = Auth::user()->id;
            $UserRole   = UserRole::where('ekanban_user_id', $UserID)->first();
            $RoleID     = $UserRole->role_id;
            $ControlAccess  = RolePermissionControl::CheckPermission($RoleID, 'control_setupSupplierDistributionRawMaterial');

            $datatable = RawMaterial::MappedRawMaterialWithSupplier();
            // With Yajra Datatable
            return Datatables::of($datatable)
                ->addColumn('action', function ($data) use ($ControlAccess){
                        $ActionButton = '';

                        if($ControlAccess){
                            $ActionButton = $ActionButton.ButtonBuilder::Build('DATATABLE', 'EDIT', 'edit-btn', 'fa fa-edit', 'Edit', '#', "row-id='$data->id' row-supplier='$data->vendor_code' row-item_code='$data->item_code' row-distribution='$data->distribution_pctg'");
                            $ActionButton = $ActionButton.ButtonBuilder::Build('DATATABLE', 'DELETE', 'delete-btn', 'ti-trash', 'Delete', '#', "row-id='$data->id' row-item_code='$data->item_code'");
                        }

                        return $ActionButton;
                    })
                ->make(true);

        } elseif ($flag==2){
            $datatable = RawMaterial::DoubleMappingItemCode();
            return Datatables::of($datatable)
                    ->make(true);

        } elseif ($flag==3){
            $datatable = RawMaterial::PctgErrorDistributionMappingItemCode();
            return Datatables::of($datatable)
                    ->make(true);

        } elseif ($flag==4){
            // Select2 Raw Material //

            // Get Preselected Data in Edit Mode
            if($itemcode !== 'ALL'){
                $rawMaterials = Item::where('itemcode', $itemcode)
                                    ->select('id', 'itemcode', 'descript', 'descript1')
                                    ->first();
            return response()->json($rawMaterials);
            }

            // Search Combobox
            $search = $request->search;
            if($search == ''){
                $rawMaterials = Item::where('state', 'RM')
                                    ->select('id', 'itemcode', 'descript', 'descript1')
                                    ->orderby('itemcode')
                                    ->get();
            } else {
                $rawMaterials = Item::where('state', 'RM')
                                    ->where(function ($query) use ($search){
                                        $query->orWhere('itemcode', 'LIKE', "%$search%")
                                            ->orWhere('descript', 'LIKE', "%$search%")
                                            ->orWhere('descript1', 'LIKE', "%$search%");
                                    })
                                    ->select('id', 'itemcode', 'descript', 'descript1')
                                    ->orderby('itemcode')
                                    ->get();
            }
            $response = array();
            foreach($rawMaterials as $rawMaterial){
                $response[] = array(
                    'id'    => $rawMaterial->itemcode,
                    'text'  => $rawMaterial->itemcode . ' :: ' . $rawMaterial->descript . ' :: ' . $rawMaterial->descript1
                );
            }
            return response()->json($response);

        } elseif ($flag==5) {
            // Select2 Supplier //

            // Get Preselected Data
            if($vendcode !== 'ALL'){
                $vendor = Vendor::where('vendcode', $vendcode)
                                    ->select('vendcode', 'company')
                                    ->first();
                return response()->json($vendor);
            }

            // Search Combobox
            $search = $request->search;
            if($search == ''){
                $vendors = Vendor::where('status_data', 'ACTIVE')
                                    ->select('vendcode', 'company')
                                    ->orderby('vendcode')
                                    ->get();
            } else {
                $vendors = Vendor::where('status_data', 'ACTIVE')
                                    ->where(function ($query) use ($search){
                                        $query->orWhere('vendcode', 'LIKE', "%$search%")
                                            ->orWhere('company', 'LIKE', "%$search%");
                                    })
                                    ->select('vendcode', 'company')
                                    ->orderby('vendcode')
                                    ->get();
            }
            $response = array();
            foreach($vendors as $vendor){
                $response[] = array(
                    'id'    => $vendor->vendcode,
                    'text'  => $vendor->vendcode . ' :: ' . $vendor->company
                );
            }
            return response()->json($response);
        }
    }

    //+++++++++++++++++++++++++++
    // POST Function
    //+++++++++++++++++++++++++++

    public function control_setupSupplierReportRawMaterial(Request $request){
        $flag      = $request->input('flag');
        $mode      = $request->input('mode');
        $id        = $request->input('id');
        $by_user   = $request->input('by_user');
        $by_type   = 'RM-SUPPLIER';
        $edit_createdBy = 'dummy';
        $edit_createdDate = '1212-12-12 00:00:00';

        if ($mode=='PARAMETER'){
            $ld_number = $request->input('ld');
            $prepared  = $request->input('prepared');
            $checked   = $request->input('checked');
            $approved  = $request->input('approved');
            $start_date = $request->input('start_date');
            $end_date   = $request->input('end_date');

            $response   = 0;
            $data = [
                'status'    => 0,
                'message'   => 'Failed posting data.'
            ];

            $response = RawMaterial::PostSetupSupplierReportParameter($flag, $ld_number, $prepared,
                                                                      $checked, $approved, $by_user,
                                                                      $by_type, $id, $start_date,
                                                                      $end_date);
            if ($flag=='ADD'){
                if ($response){
                    $data = [
                        'status'    => 1,
                        'message'   => 'Success Added Report Parameter'
                    ];
                }
            } elseif ($flag=='EDIT'){
                if ($response){
                    $data = [
                        'status'    => 1,
                        'message'   => 'Success Updated Report Parameter'
                    ];
                }
            } elseif ($flag=='DELETE'){
                if ($response){
                    $data = [
                        'status'    => 1,
                        'message'   => 'Success Deleted Report Parameter'
                    ];
                }
            }
        } if ($mode=='CLUSTERIZATION'){
            $supplier = $request->input('supplier');

            $response   = 0;
            $data = [
                'status'    => 0,
                'message'   => 'Failed posting data.'
            ];

            if ($flag=='ADD'){
                $response = RawMaterial::PostSetupSupplierReportClusterization($flag, $supplier, $by_user,
                            $by_type, $id, $edit_createdBy, $edit_createdDate);

                if ($response){
                    $data = [
                        'status'    => 1,
                        'message'   => 'Success Added Report Clusterization'
                    ];
                }
            } elseif ($flag=='EDIT'){
                $EditResponse = RawMaterial::PostSetupSupplierReportClusterization($flag, $supplier, $by_user,
                                $by_type, $id, $edit_createdBy, $edit_createdDate);
                /* ADD UPDATED DATA */
                $edit_createdDate = $EditResponse[0]->created_date;
                $edit_createdBy = $EditResponse[0]->created_by;
                $responseEdit = $EditResponse[0]->response;

                if($responseEdit){
                    $response = RawMaterial::PostSetupSupplierReportClusterization('EDIT_ADD', $supplier, $by_user,
                                $by_type, $id, $edit_createdBy, $edit_createdDate);
                }

                if ($responseEdit && $response){
                    $data = [
                        'status'    => 1,
                        'message'   => 'Success Updated Report Clusterization'
                    ];
                }
            } elseif ($flag=='DELETE'){
                $response = RawMaterial::PostSetupSupplierReportClusterization($flag, $supplier, $by_user,
                            $by_type, $id, $edit_createdBy, $edit_createdDate);

                if ($response){
                    $data = [
                        'status'    => 1,
                        'message'   => 'Success Deleted Report Clusterization'
                    ];
                }
            }
        }

        return $data;
    }

    public function control_forecastNoteRawMaterial(Request $request){
        $items       = $request->input('item');
        $id          = $request->input('id');
        $flag        = $request->input('flag');
        $rev_no      = $request->input('rev_no');
        $by_user     = $request->input('by_user');
        $vendor_code = $request->input('vendor_code');
        $period      = $request->input('period');
        $create_date = $request->input('create_date');

        $item_code          = 'dummy';
        $sc_tm_qty          = 0;
        $sc_nm1_qty         = 0;
        $sc_nm2_qty         = 0;
        $sc_nm3_qty         = 0;
        $sc_nm4_qty         = 0;
        $sc_nm5_qty         = 0;
        $sc_nm6_qty         = 0;
        $edit_createdBy     = 'dummy';
        $edit_createdDate   = '1212-12-12 00:00:00';
        $model              = 'dummy';

        $response   = 0;
        $data = [
            'status'    => 0,
            'message'   => 'Failed posting data.'
        ];

        if ($flag=='ADD'){
            // Loop through table data to read then insert to database by Stored Procedure
            foreach($items as $item){
                // Assign data to Variable
                $item_code  = $item['item_code'];
                $sc_tm_qty  = $item['tm_kg'];
                $sc_nm1_qty = $item['nm1_kg'];
                $sc_nm2_qty = $item['nm2_kg'];
                $sc_nm3_qty = $item['nm3_kg'];
                $sc_nm4_qty = $item['nm4_kg'];
                $sc_nm5_qty = $item['nm5_kg'];
                $sc_nm6_qty = $item['nm6_kg'];
                $model      = $item['model'];

                // Save data to database by stored procedure
                $response = RawMaterial::PostForecastNote(
                                $flag, $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                                $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                                $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);
            }

            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Added Forecast Note'
                ];
            }
        } elseif ($flag=='EDIT'){
            /* REMOVE EXISTING DATA */
            $EditResponse = RawMaterial::PostForecastNote(
                $flag, $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);

            /* ADD UPDATED DATA */
            $edit_createdDate = $EditResponse[0]->created_date;
            $edit_createdBy = $EditResponse[0]->created_by;
            $responseEdit = $EditResponse[0]->response;

            if($responseEdit){
                foreach($items as $item){
                    $item_code  = $item['item_code'];
                    $sc_tm_qty  = $item['tm_kg'];
                    $sc_nm1_qty = $item['nm1_kg'];
                    $sc_nm2_qty = $item['nm2_kg'];
                    $sc_nm3_qty = $item['nm3_kg'];
                    $sc_nm4_qty = $item['nm4_kg'];
                    $sc_nm5_qty = $item['nm5_kg'];
                    $sc_nm6_qty = $item['nm6_kg'];
                    $model      = $item['model'];

                    $response = RawMaterial::PostForecastNote(
                                    'EDIT_ADD', $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                                    $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                                    $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);
                }
            }

            if ($responseEdit && $response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Updated Forecast Note'
                ];
            }

        } elseif ($flag=='DELETE'){
            $response = RawMaterial::PostForecastNote(
                $flag, $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);

            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Deleted Forecast Note'
                ];
            }
        } elseif ($flag=='VER_UP'){

            $prev_rev_no = sprintf("%02d", $rev_no - 1);

            /* DELETE PREVIOUS VERSION */
            $deleteResponse = RawMaterial::PostForecastNote(
                'DELETE', $id, $vendor_code, $period, $prev_rev_no, $create_date, $item_code,
                $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);

            /* ADD VER UP DATA */
            if ($deleteResponse){
                foreach($items as $item){
                    $item_code  = $item['item_code'];
                    $sc_tm_qty  = $item['tm_kg'];
                    $sc_nm1_qty = $item['nm1_kg'];
                    $sc_nm2_qty = $item['nm2_kg'];
                    $sc_nm3_qty = $item['nm3_kg'];
                    $sc_nm4_qty = $item['nm4_kg'];
                    $sc_nm5_qty = $item['nm5_kg'];
                    $sc_nm6_qty = $item['nm6_kg'];
                    $model      = $item['model'];

                    $insertResponse = RawMaterial::PostForecastNote(
                                        'ADD', $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                                        $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                                        $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);
                }
            }

            if ($deleteResponse && $insertResponse){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Ver UP Forecast Note'
                ];
            }
        }

        return $data;
    }

    public function control_setupSupplierDistributionRawMaterial(Request $request){
        $flag = $request->input('flag');
        $id = $request->input('id');
        $item_code = $request->input('item_code');
        $supplier = $request->input('supplier');
        $distribution = $request->input('distribution');
        $by_user = $request->input('by_user');
        $by_type = 'RM-SUPPLIER';

        $response = 0;
        $data = [
            'status'    => 0,
            'message'   => 'Failed posting data.'
        ];

        $response = RawMaterial::PostSupplierDistribution($flag, $item_code, $supplier, $distribution, $by_user, $by_type, $id);
        if ($flag=='ADD'){
            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Added Supplier Mapping'
                ];
            }
        } elseif ($flag=='EDIT'){
            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Updated Supplier Mapping'
                ];
            }
        } elseif ($flag=='DELETE'){
            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Deleted Supplier Mapping'
                ];
            }
        }

        return $data;
    }

    public function approve_forecastNoteRawMaterial(Request $request){
        $flag        = $request->input('flag');
        $by_user     = $request->input('by_user');
        $vendor_code = $request->input('vendor_code');
        $period      = $request->input('period');
        $create_date = $request->input('create_date');

        $id         = 0;
        $rev_no     = 'dummy';
        $item_code  = 'dummy';
        $sc_tm_qty  = 0;
        $sc_nm1_qty = 0;
        $sc_nm2_qty = 0;
        $sc_nm3_qty = 0;
        $sc_nm4_qty = 0;
        $sc_nm5_qty = 0;
        $sc_nm6_qty = 0;
        $edit_createdBy   = 'dummy';
        $edit_createdDate = '1212-12-12 00:00:00';
        $model            = 'dummy';

        $response   = 0;
        $data = [
            'status'    => 0,
            'message'   => 'Failed posting data.'
        ];

        if ($flag=='APPROVE'){
            $response = RawMaterial::PostForecastNote(
                $flag, $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);

            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Approved Forecast Note'
                ];
            }
        } elseif ($flag=='UNAPPROVE'){
            $response = RawMaterial::PostForecastNote(
                $flag, $id, $vendor_code, $period, $rev_no, $create_date, $item_code,
                $sc_tm_qty, $sc_nm1_qty, $sc_nm2_qty, $sc_nm3_qty, $sc_nm4_qty, $sc_nm5_qty,
                $sc_nm6_qty, $by_user, $edit_createdBy, $edit_createdDate, $model);

            if ($response){
                $data = [
                    'status'    => 1,
                    'message'   => 'Success Un-Approved Forecast Note'
                ];
            }
        }

        return $data;
    }


}
