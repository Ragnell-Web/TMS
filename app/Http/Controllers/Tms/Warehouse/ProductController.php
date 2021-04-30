<?php

namespace App\Http\Controllers\TMS\Warehouse;

// Laravel Libraries
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use PDF;

// Classes
use App\Classes\ButtonBuilder As ButtonBuilder;

// Controllers
use App\Http\Controllers\RolePermissionController As RolePermissionControl;

// Models
use App\Models\User_Role As UserRole;
use App\Models\Dbtbs\Item As Item;
use App\Models\Dbtbs\Formula As Formula;
use App\Models\Ekanban\Stock_Balance As StockBalance;

class ProductController extends Controller
{
    public function index(){
        return view('tms.warehouse.product.index');
    }

    public function datatables(){
        $products = Item::select('id', 'itemcode', 'state', 'descript', 'descript1', 'custcode', 'part_no')
            ->where('fpcode', '!=', 'UN-USED')
            ->where('types', 'MN');
        return  DataTables::of($products)
            ->addColumn('link-itemcode', function($data){
                return "<a class='row-item view' href='".route('tms.warehouse.products.view', $data->id)."' row-id='$data->id'>".$data->itemcode."</a>";
            })->escapeColumns([])
            ->make(true);
    }

    public function datatablesBom($itemcode){
        $formulas = Formula::getChild($itemcode);
        return Datatables::of($formulas)
            ->addColumn('itemcode', function($data){
                if($data->id !== null) {
                    return "<a class='row-item view' href='".route('tms.warehouse.products.view', $data->id)."' row-id='$data->id'>".$data->itemcode."</a>";
                } else {
                    return "<i>ITEM NOT EXISTS</i>";
                }
            })->escapeColumns([])
            ->make(true);
    }

    public function highchartsBom($itemcode){
        $formulas = Formula::getBomTree($itemcode);
        $output = [
            'chartData' => $formulas
        ];
        return response()->json($output);
    }

    public function get($id){
        $products = Item::find($id);
        return response()->json($products);
    }

    public function getStockStatus($itemcode){
        $period  = date("Y-m");
        $status  = StockBalance::getItemStatus($period, $itemcode);
        return response()->json($status);
    }

    public function printStockCard($itemcode){
        $period    = date("Y-m");
        $output    = [
            'item'  => Item::where('itemcode', $itemcode)->get(),
            'data'  => StockBalance::getStockCard($period, $itemcode)
        ];

        $pdf = PDF::loadview('tms.warehouse.product.report-stock-card', $output);
        return $pdf->stream('STOCK CARD - ' . $itemcode);
    }

    public function view($id){
        $products = Item::where('item.id', $id)
            ->leftJoin('stock_state', 'stock_state.state', '=', 'item.state')
            ->select('item.id AS id', 'item.itemcode AS ITEMCODE', 'item.state AS STATE_CODE',
                     'stock_state.descript AS STATE_NAME', 'item.descript AS DESCRIPT', 'item.descript1 AS DESCRIPT1',
                     'item.part_no AS PART_NO')
            ->first();
        $breadcrumbItem = ['product' => Item::find($id)];
        $data     = [
            'action'            => '_VIEW',
            'data'              => $products,
            'breadcrumbItem'    => $breadcrumbItem
        ];
        return view('tms.warehouse.product.form')->with($data);
    }
}
