<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('login', ['uses' => 'LoginController@login', 'as' => 'login']);
Route::post('login', ['uses' => 'LoginController@postLogin', 'as' => 'postlogin']);
Route::get('logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);

Route::get('reset-password', ['uses' => 'LoginController@resetPassword', 'as' => 'reset-password']);


// Middleware to check that user has account in TMS
Route::group([ 'middleware' => 'app.user'], function (){
	Route::get('/', ['uses' => 'PortalController@index', 'as' => 'home']);
    Route::get('/portal', ['uses' => 'PortalController@index', 'as' => 'portal']);
    Route::get('/home', ['uses' => 'MainController@home', 'as' => 'home']);

    /*
    | ================================================
    | Create New Prefix for each Modules
    | ------------------------------------------------
    |      Current Prefixes:
    |          1. admin
    |          2. TMS
    | ================================================
    */

    // PREFIX:: ADMIN
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/', ['uses' => 'AdminController@dashboard', 'as' => 'admin.dashboard']);

        /*
        | ----------------------------------------------------
        | Users
        | ----------------------------------------------------
        |   1. Index Page               :: PAGE ::
        |       1.1. Get Datatables     :: GET  :: JSON ::
        |   2. Form Edit Page           :: PAGE ::
        |       2.1. Edit User          :: POST ::
        | ----------------------------------------------------
        */

        //  1. Index Page
        Route::get('/users', ['uses' => 'UserController@index', 'as' => 'admin.users']);
        //  1.1. Get Datatable
        Route::get('/users/getDatatables', ['uses' => 'UserController@getDatatables', 'as' => 'admin.users.getDatatables']);

        //  2. View Page
        Route::get('/users/{id}', ['uses' => 'UserController@view', 'as' => 'admin.users.view']);

        //  2. Form Edit Page
        Route::get('/users/{id}/edit', ['uses' => 'UserController@pageEdit', 'as' => 'admin.users.edit']);
        //  2.1. Edit User
        Route::post('/users/{id}/edit/post', ['uses' => 'UserController@edit', 'as' => 'admin.users.edit.post']);


        /*
        | ----------------------------------------------------
        | End of Users Routes
        | ----------------------------------------------------
        */


        /*
        | ----------------------------------------------------
        | Roles
        | ----------------------------------------------------
        |   1. Index Page                   :: PAGE ::
        |       1.1. Get Datatable          :: GET  :: JSON ::
        |       1.2. Add New Role           :: POST :: JSON ::
        |       1.3. Edit Role              :: POST :: JSON ::
        |       1.4. Get Detail             :: GET  :: JSON ::
        |       1.5. Delete Role            :: POST :: JSON ::
        |   2. Role Permission Page         :: PAGE ::
        |       2.1. Save Role Permission   :: POST :: JSON ::
        |       2.2. Get Role Permission    :: GET  :: JSON ::
        | ----------------------------------------------------
        */

        //  1. Index Page
        Route::get('/roles', ['uses' => 'RoleController@index', 'as' => 'admin.roles']);

        //  1.1. Get Datatable
        Route::get('/roles/datatable', ['uses' => 'RoleController@getDatatables', 'as' => 'admin.roles.datatable']);

        // 1.2. Add New Role            :: POST :: JSON ::
        Route::post('/roles/add', ['uses' => 'RoleController@add', 'as' => 'admin.roles.add']);

        // 1.3. Edit Role               :: POST :: JSON ::
        Route::post('/roles/{id}/edit', ['uses' => 'RoleController@edit', 'as' => 'admin.roles.edit']);

        // 1.4. Get Role Detail         :: GET  :: JSON ::
        Route::get('/roles/{id}/detail', ['uses' => 'RoleController@detail', 'as' => 'admin.roles.detail']);

        // 1.5. Delete Role             :: POST :: JSON ::
        Route::post('/roles/{id}/delete', ['uses' => 'RoleController@delete', 'as' => 'admin.roles.delete']);

        // 2.   Role Permission Page    :: PAGE ::
        Route::get('/roles/{id}/permission', ['uses' => 'RolePermissionController@index', 'as' => 'admin.roles.permission']);

        // 2.1. Save Role Permission    :: POST :: JSON ::
        Route::post('/roles/{id}/permission/save', ['uses' => 'RolePermissionController@save', 'as' => 'admin.roles.permission.save']);

        // 2.2. Get Role Permission     :: GET :: JSON ::
        Route::get('/roles/{id}/permission/get', ['uses' => 'RolePermissionController@get', 'as' => 'admin.roles.permission.get']);


        /*
        | ----------------------------------------------------
        | End of Roles Routes
        | ----------------------------------------------------
        */


        /*
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |   MODULES
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |
        |   1. Index Page - - - - - - - - - - - :: PAGE ::
        |       1.1. Get Datatables - - - - - - :: GET  :: JSON ::
        |       1.2. Delete Module - - - - - -  :: POST :: JSON ::
        |   2. Form Page - - - - - - - - - - -  :: PAGE ::
        |       2.1. Post New Module - - - - -  :: POST ::
        |       2.2. Edit Module Page - - - - - :: PAGE ::
        |       2.3. Edit Module Post - - - - - :: POST ::
        |   3. Module Builder Page - - - - - -  :: PAGE ::
        |       3.1. Get Nestable - - - - - - - :: GET  :: JSON ::
        |       3.2. Get Detail - - - - - - - - :: GET  :: JSON ::
        |       3.3. Add Module Item - - - - -  :: POST :: JSON ::
        |       3.4. Edit Module Item - - - - - :: POST :: JSON ::
        |       3.5. Delete Module Item Post -  :: POST :: JSON ::
        |       3.6. Re-order Module Item - - - :: POST :: JSON ::
        |   4. Module Item Permission - - - - - :: PAGE ::
        |       4.1. Get Nestable - - - - - - - :: GET  :: JSON ::
        |       4.2. Get Detail - - - - - - - - :: GET  :: JSON ::
        |       4.3. Add Permission - - - - - - :: POST :: JSON ::
        |       4.4. Edit Permission - - - - -  :: POST :: JSON ::
        |       4.5. Delete Permission - - - -  :: POST :: JSON ::
        |
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */

        //  1. Index Page
        Route::get('/modules', ['uses' => 'ModuleController@index', 'as' => 'admin.modules']);
        //  1.1. Get Datatable
        Route::get('/modules/getDatatables', ['uses' => 'ModuleController@getDatatables', 'as' => 'admin.modules.getDatatables']);
        //  1.2. Delete Module Post
        Route::post('/modules/{id}/delete', ['uses' => 'ModuleController@delete', 'as' => 'admin.modules.delete']);

        //  2. Form Page
        Route::get('/modules/add', ['uses' => 'ModuleController@add', 'as' => 'admin.modules.add']);
        //  2.1. Post New Module
        Route::post('/modules/post', ['uses' => 'ModuleController@post', 'as' => 'admin.modules.post']);
        //  2.2. Edit Module Page
        Route::get('/modules/{id}/edit', ['uses' => 'ModuleController@edit', 'as' => 'admin.modules.edit']);
        //  2.3. Edit Module Post
        Route::post('/modules/{id}/postEdit', ['uses' => 'ModuleController@postEdit', 'as' => 'admin.modules.postEdit']);


        //  3. Module Builder Page
        Route::get('/modules/{id}/item', ['uses' => 'ModuleItemController@index', 'as' => 'admin.modules.item']);
        //  3.1 Get Nestable
        Route::get('/modules/{id}/item/nestable', ['uses' => 'ModuleItemController@generateNestable', 'as' => 'admin.modules.item.nestable']);
        //  3.2 Get Detail
        Route::get('/modules/{id}/item/{item_id}/detail', ['uses' => 'ModuleItemController@detail', 'as' => 'admin.modules.item.detail']);
        //  3.3 Add Module Item Post    :: POST :: JSON ::
        Route::post('/modules/{id}/item/add', ['uses' => 'ModuleItemController@add', 'as' => 'admin.modules.item.add']);
        //  3.4 Edit Module Item Post   :: POST :: JSON ::
        Route::post('/modules/{id}/item/edit', ['uses' => 'ModuleItemController@edit', 'as' => 'admin.modules.item.edit']);
        //  3.4 Delete Module Item Post
        Route::post('/modules/{id}/item/{item_id}/delete', ['uses' => 'ModuleItemController@delete', 'as' => 'admin.modules.item.delete']);
        //  3.5 Re-order Module Item Post
        Route::post('/modules/{id}/item/reorder', ['uses' => 'ModuleItemController@reorder', 'as' => 'admin.modules.item.reorder']);

        //  4. Module Item Permission :: PAGE ::
        Route::get('/modules/{id}/item/{item_id}/permission', ['uses' => 'ModuleItemPermissionController@index', 'as' => 'admin.modules.item.permission']);
        //  4.1. Get Nestable
        Route::get('/modules/{id}/item/{item_id}/permission/nestable', ['uses' => 'ModuleItemPermissionController@getNestable', 'as' => 'admin.modules.item.permission.nestable']);
        //  4.2. Get Detail
        Route::get('/modules/{id}/item/{item_id}/permission/{permission_id}/detail', ['uses' => 'ModuleItemPermissionController@detail', 'as' => 'admin.modules.item.permission.detail']);
        //  4.3. Add Permission :: POST ::
        Route::post('/modules/{id}/item/{item_id}/permission/add', ['uses' => 'ModuleItemPermissionController@add', 'as' => 'admin.modules.item.permission.add']);
        //  4.4. Edit Permission :: POST ::
        Route::post('/modules/{id}/item/{item_id}/permission/{permission_id}/edit', ['uses' => 'ModuleItemPermissionController@edit', 'as' => 'admin.modules.item.permission.edit']);
        //  4.5. Delete Permission :: POST ::
        Route::post('/modules/{id}/item/{item_id}/permission/{permission_id}/delete', ['uses' => 'ModuleItemPermissionController@delete', 'as' => 'admin.modules.item.permission.delete']);
        //  4.6. Re-order Permission :: POST ::
        Route::post('/modules/{id}/item/{item_id}/permission/reorder', ['uses' => 'ModuleItemPermissionController@reorder', 'as' => 'admin.modules.item.permission.reorder']);

    });


    // PREFIX:: TMS
    Route::group(['prefix' => 'tms'], function() {
        Route::get('/', 'TMS\tms_HomeController@index')->name('tms_Dashboard');
        Route::get('/change_password', 'TMS\tms_HomeController@change_password')->name('tms_ChangePassword');

        /*
        | ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |   TMS - MANUFACTURING
        | ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |
        |   1. Production Plan
        |       1.1. Dashboard  - - - - - - - - - - - - - - - -  :: PAGE ::
        |           1.1.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |       2.1. Capacity vs Loading Summary per Month  - -  :: PAGE ::
        |           2.1.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |       2.2. Capacity vs Loading Summary per Date - - -  :: PAGE ::
        |           2.2.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |       2.3. Capacity vs Loading Summary per Machine  -  :: PAGE ::
        |           2.3.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |       2.4. Capacity vs Loading Detail per Date  - - -  :: PAGE ::
        |           2.4.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |       2.5. Capacity vs Loading Detail per Machine - -  :: PAGE ::
        |           2.5.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |   2. Raw Material
        |       2.1. Dashboard  - - - - - - - - - - - - - - - -  :: PAGE ::
        |           2.1.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |       2.2. Setup Supplier Distribution  - - - - - - -  :: PAGE ::
        |           2.2.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |           2.2.2. CRUD Function  - - - - - - - - - - -  :: POST :: JSON ::
        |       2.3. Setup Lot  - - - - - - - - - - - - - - - -  :: PAGE ::
        |       2.4. Forecast Note  - - - - - - - - - - - - - -  :: PAGE ::
        |           2.4.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |           2.4.2. CRUD Function  - - - - - - - - - - -  :: POST :: JSON ::
        |           2.4.3. APPROVE Function   - - - - - - - - -  :: POST :: JSON ::
        |       2.5. Setup Supplier Report  - - - - - - - - - -  :: PAGE ::
        |           2.5.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        |           2.5.2. CRUD Function  - - - - - - - - - - -  :: POST :: JSON ::
        |       2.6. Reference BoM  - - - - - - - - - - - - - -  :: PAGE ::
        |           2.6.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        | ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */

        // 1. Production Plan
        // 1.1. Dashboard  - - - - - - - - - - - - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_indexProductionPlan', ['uses' => 'TMS\Manufacturing\ProductionPlanController@index', 'as' => 'tms.manufacturing.production-plan.index']);
        // 1.1.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::

        // 2.1. Capacity vs Loading Summary per Month  - -  :: PAGE ::
        Route::get('/manufacturing/view_summaryLoadingCapacityPerMonthProductionPlan', ['uses' => 'TMS\Manufacturing\ProductionPlanController@summaryLoadingCapacityPerMonth', 'as' => 'tms.manufacturing.production-plan.summaryLoadingCapacityPerMonth']);
        // 2.1.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_summaryLoadingCapacityPerMonthProductionPlan/get_datSummaryLoadingCapacityPerMonth', ['uses' => 'TMS\Manufacturing\ProductionPlanController@get_datSummaryLoadingCapacityPerMonth', 'as' => 'tms.manufacturing.production-plan.get_datSummaryLoadingCapacityPerMonth']);

        // 2.2. Capacity vs Loading Summary per Date - - -  :: PAGE ::
        Route::get('/manufacturing/view_summaryLoadingCapacityPerDateProductionPlan', ['uses' => 'TMS\Manufacturing\ProductionPlanController@summaryLoadingCapacityPerDate', 'as' => 'tms.manufacturing.production-plan.summaryLoadingCapacityPerDate']);
        // 2.2.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_summaryLoadingCapacityPerDateProductionPlan/get_datSummaryLoadingCapacityPerDate', ['uses' => 'TMS\Manufacturing\ProductionPlanController@get_datSummaryLoadingCapacityPerDate', 'as' => 'tms.manufacturing.production-plan.get_datSummaryLoadingCapacityPerDate']);

        // 2.3. Capacity vs Loading Summary per Machine  -  :: PAGE ::
        Route::get('/manufacturing/view_summaryLoadingCapacityPerMachineProductionPlan', ['uses' => 'TMS\Manufacturing\ProductionPlanController@summaryLoadingCapacityPerMachine', 'as' => 'tms.manufacturing.production-plan.summaryLoadingCapacityPerMachine']);
        // 2.3.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_summaryLoadingCapacityPerMachineProductionPlan/get_datSummaryLoadingCapacityPerMachine', ['uses' => 'TMS\Manufacturing\ProductionPlanController@get_datSummaryLoadingCapacityPerMachine', 'as' => 'tms.manufacturing.production-plan.get_datSummaryLoadingCapacityPerMachine']);

        // 2.4. Capacity vs Loading Detail per Date  - - -  :: PAGE ::
        Route::get('/manufacturing/view_detailLoadingCapacityPerDateProductionPlan', ['uses' => 'TMS\Manufacturing\ProductionPlanController@detailLoadingCapacityPerDate', 'as' => 'tms.manufacturing.production-plan.detailLoadingCapacityPerDate']);
        // 2.4.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_detailLoadingCapacityPerDateProductionPlan/get_datDetailLoadingCapacityPerDate', ['uses' => 'TMS\Manufacturing\ProductionPlanController@get_datDetailLoadingCapacityPerDate', 'as' => 'tms.manufacturing.production-plan.get_datDetailLoadingCapacityPerDate']);


        Route::get('/ManufacturingPlanning_LoadingCapacityPerMachineDetails', 'TMS\tms_ManufacturingController@ManufacturingPlanning_LoadingCapacityPerMachineDetails_index')->name('LoadingCapacityPerMachineDetails');

        Route::get('/get_dtPlanningDetailPerMachine/{process}/{period}/{machine}/{plan_date}/{shift}/{flag}', 'TMS\json_ManufacturingController@get_dtPlanningDetailPerMachine');
        Route::get('/get_dtPlanningDetailPerMachineByOp/{process}/{period}/{machine}/{plan_date}/{flag}', 'TMS\json_ManufacturingController@get_dtPlanningDetailPerMachineByOp');



        // Master Data Module
        Route::get('/MasterItem_Index', 'TMS\tms_MasterController@MasterItem_Index')->name('tms_MasterItem_Index');

        Route::get('/get_dtItem', 'TMS\json_MasterController@get_dtItem');
        Route::post('/post_entryItem', 'TMS\json_MasterController@post_entryItem');

        // 2. Raw Material
        // 2.1. Dashboard  - - - - - - - - - - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_indexRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@index', 'as' => 'tms.manufacturing.raw-material.index']);
        // 2.1.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        // Route::get('/manufacturing/view_forecastNoteRawMaterial/{vend_code}/{period}/{flag}/get_datForecastNote', ['uses' => 'TMS\Manufacturing\RawMaterialController@get_datForecastNote', 'as' => 'tms.manufacturing.raw-material.forecast-note.get_datForecastNote']);

        // 2.2. Setup Supplier Distribution- - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_setupSupplierDistributionRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@setupSupplierDistribution', 'as' => 'tms.manufacturing.raw-material.setup-supplier-distribution']);
        // 2.2.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_setupSupplierReportRawMaterial/{flag}/{itemcode}/{vendcode}/get_datSupplierDistribution', ['uses' => 'TMS\Manufacturing\RawMaterialController@get_datSupplierDistribution', 'as' => 'tms.manufacturing.raw-material.setup-supplier-distribution.get_datSupplierDistribution']);
        // 2.2.2. CRUD Function  - - - - - - - - - - -  :: POST :: JSON ::
        Route::get('/manufacturing/view_setupSupplierDistributionRawMaterial/control_setupSupplierDistributionRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@control_setupSupplierDistributionRawMaterial', 'as' => 'tms.manufacturing.raw-material.setup-supplier-distribution.control_setupSupplierDistributionRawMaterial']);

        // 2.3. Setup Lot  - - - - - - - - - - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_setupLotRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@setupLot', 'as' => 'tms.manufacturing.raw-material.setup-lot']);

        // 2.4. Forecast Note  - - - - - - - - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_forecastNoteRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@forecastNote', 'as' => 'tms.manufacturing.raw-material.forecast-note']);
        // 2.4.1. Get Data - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_forecastNoteRawMaterial/{vend_code}/{period}/{flag}/get_datForecastNote', ['uses' => 'TMS\Manufacturing\RawMaterialController@get_datForecastNote', 'as' => 'tms.manufacturing.raw-material.forecast-note.get_datForecastNote']);
        // 2.4.2 CRUD Function - - - - - - - - - - - -  :: POST :: JSON ::
        Route::post('/manufacturing/view_forecastNoteRawMaterial/control_forecastNoteRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@control_forecastNoteRawMaterial', 'as' => 'tms.manufacturing.raw-material.forecast-note.control_forecastNoteRawMaterial']);
        // 2.4.2 APPROVE Function  - - - - - - - - - -  :: POST :: JSON ::
        Route::post('/manufacturing/view_forecastNoteRawMaterial/approve_forecastNoteRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@approve_forecastNoteRawMaterial', 'as' => 'tms.manufacturing.raw-material.forecast-note.approve_forecastNoteRawMaterial']);

        // 2.5. Setup Supplier Report  - - - - - - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_setupSupplierReportRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@setupSupplierReport', 'as' => 'tms.manufacturing.raw-material.setup-supplier-report']);
        // 2.5.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_setupSupplierReportRawMaterial/{flag}/get_datSupplierReport', ['uses' => 'TMS\Manufacturing\RawMaterialController@get_datSupplierReport', 'as' => 'tms.manufacturing.raw-material.setup-supplier-report.get_datSupplierReport']);
        // 2.5.2. CRUD Function  - - - - - - - - - - - - -  :: POST :: JSON ::
        Route::post('/manufacturing/view_setupSupplierReportRawMaterial/control_setupSupplierReportRawMaterial', ['uses' => 'TMS\Manufacturing\RawMaterialController@control_setupSupplierReportRawMaterial', 'as' => 'tms.manufacturing.raw-material.setup-supplier-report.control_setupSupplierReportRawMaterial']);

        // 2.6. Reference BoM  - - - - - - - - - - - - - -  :: PAGE ::
        Route::get('/manufacturing/view_referenceBom', ['uses' => 'TMS\Manufacturing\RawMaterialController@referenceBom', 'as' => 'tms.manufacturing.raw-material.reference-bom']);
        // 2.6.1. Get Data - - - - - - - - - - - - - - - -  :: GET  :: JSON ::
        Route::get('/manufacturing/view_referenceBom/{flag}/{keyword}/get_datReferenceBom', ['uses' => 'TMS\Manufacturing\RawMaterialController@get_datReferenceBom', 'as' => 'tms.manufacturing.raw-material.reference-bom.get_datReferenceBom']);

        /*
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |   TMS - WAREHOUSE
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |
        |   1. Products - - - - - - - - - - - - - - :: PAGE ::
        |       1.1. Get Datatables - - - - - - - - :: GET  :: JSON ::
                2.1. View Products  - - - - - - - - :: PAGE ::
        |   2. Transfer Order - - - - - - - - - - - :: PAGE ::
        |       2.1. Get Datatables - - - - - - - - :: GET  :: JSON ::
        |       2.2. Get Header - - - - - - - - - - :: GET  :: JSON ::
        |
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */

        //  1. Products
        Route::get('/warehouse/products', ['uses' => 'TMS\Warehouse\ProductController@index', 'as' => 'tms.warehouse.products']);
        Route::post('/warehouse/products/datatables', ['uses' => 'TMS\Warehouse\ProductController@datatables', 'as' => 'tms.warehouse.products.datatables']);
        Route::get('/warehouse/products/{id}/view', ['uses' => 'TMS\Warehouse\ProductController@view', 'as' => 'tms.warehouse.products.view']);
        Route::get('/warehouse/products/{itemcode}/datatables/bom', ['uses' => 'TMS\Warehouse\ProductController@datatablesBom', 'as' => 'tms.warehouse.products.bom.datatables']);
        Route::get('/warehouse/products/{itemcode}/highcharts/bom', ['uses' => 'TMS\Warehouse\ProductController@highchartsBom', 'as' => 'tms.warehouse.products.bom.highcharts']);
        // Route::get('/warehouse/products/{itemcode}/balance', ['uses' => 'TMS\Warehouse\ProductController@getCurrentBalance', 'as' => 'tms.warehouse.products.balance']);
        Route::get('/warehouse/products/{itemcode}/stock-status', ['uses' => 'TMS\Warehouse\ProductController@getStockStatus', 'as' => 'tms.warehouse.products.stock-status']);
        Route::get('/warehouse/products/{itemcode}/stock-card', ['uses' => 'TMS\Warehouse\ProductController@printStockCard', 'as' => 'tms.warehouse.products.stock-card']);

        //  2. Transfer Order   :: PAGE ::
        Route::get('/warehouse/transfer-order', ['uses' => 'TMS\Warehouse\TransferOrderController@index', 'as' => 'tms.warehouse.transfer-order']);
        Route::get('/warehouse/transfer-order/datatable-hdr', ['uses' => 'TMS\Warehouse\TransferOrderController@getDatatablesHeader', 'as' => 'tms.warehouse.transfer-order.datatables.header']);
        Route::get('/warehouse/transfer-order/{id}/detail', ['uses' => 'TMS\Warehouse\TransferOrderController@getDetail', 'as' => 'tms.warehouse.transfer-order.detail']);



        //  3. Delivery Order   :: PAGE ::
        Route::get('/warehouse/deliveryorder', ['uses' => 'TMS\Warehouse\DeliveryOrderController@index', 'as' => 'tms.warehouse.deliveryorder']);
        Route::get('/warehouse/deliveryorder/datatables', ['uses' => 'TMS\Warehouse\DeliveryOrderController@getDatatablesDO', 'as' => 'tms.warehouse.deliveryorder.datatables']);
        Route::get('/warehouse/deliveryorder/datatables_search/{by}/{value}', ['uses' => 'TMS\Warehouse\DeliveryOrderController@searchDatatablesDO', 'as' => 'tms.warehouse.deliveryorder.datatables.search']);
        Route::get('/warehouse/deliveryorder/customer', ['uses' => 'TMS\Warehouse\DeliveryOrderController@getAllCustomer', 'as' => 'tms.warehouse.deliveryorder.customer']);
        Route::get('/warehouse/deliveryorder/getssoheader', ['uses' => 'TMS\Warehouse\DeliveryOrderController@getDataSSOforDOHeader', 'as' => 'tms.warehouse.deliveryorder.ssoheader']);
        Route::get('/warehouse/deliveryorder/getssodetail', ['uses' => 'TMS\Warehouse\DeliveryOrderController@getDataSSOforDODetail', 'as' => 'tms.warehouse.deliveryorder.ssodetail']);
        Route::get('/warehouse/deliveryorder/getdatadodetail', ['uses' => 'TMS\Warehouse\DeliveryOrderController@getDataDeliveryOrder', 'as' => 'tms.warehouse.deliveryorder.dodetail']);
        Route::post('/warehouse/deliveryorder/save', ['uses' => 'TMS\Warehouse\DeliveryOrderController@saveDataDeliveryOrder', 'as' => 'tms.warehouse.deliveryorder.save']);
        Route::delete('/warehouse/deliveryorder/void/{do}', ['uses' => 'TMS\Warehouse\DeliveryOrderController@voidDataDeliveryOrder', 'as' => 'tms.warehouse.deliveryorder.void']);

        // 4. MTO Entry :: PAGE ::
        Route::get('/warehouse/mto_entry', [
            'uses' => 'TMS\Warehouse\MtoEntryController@index',
            'as' => 'tms.warehouse.mto-entry'
        ]);
        Route::get('/warehouse/mto_entry/datatables', [
            'uses' => 'TMS\Warehouse\MtoEntryController@getMtoDatatables',
            'as' => 'tms.warehouse.mto-entry_datatables'
        ]);

        Route::get('/warehouse/mto_entry/datatables_choice_data', [
            'uses' => 'TMS\Warehouse\MtoEntryController@getPopUpChoiceDataDatatables',
            'as' => 'tms.warehouse.mto-entry_datatables_choice_data'
        ]);
        Route::post('/warehouse/mto_entry/store-mto', [
            'uses' => 'TMS\Warehouse\MtoEntryController@StoreMtoData',
            'as' => 'tms.warehouse.mto-entry_store_mto_data'
        ]);

        Route::get('/warehouse/mto_entry/{id}/show_detail_mto', [
            'uses' => 'TMS\Warehouse\MtoEntryController@show_view_detail',
            'as' => 'tms.warehouse.mto-entry_show_view_detail'
        ]);

        Route::get('/warehouse/mto_entry/{id}/edit_mto_data', [
            'uses' => 'TMS\Warehouse\MtoEntryController@editMtoData',
            'as' => 'tms.warehouse.mto-entry_edit_mto_data'
        ]);
        Route::put('/warehouse/mto_entry/update_mto_data/{id}', [
            'uses' => 'TMS\Warehouse\MtoEntryController@updateMtoEntry',
            'as' => 'tms.warehouse.mto-entry_update_mto_entry'
        ]);
        Route::put('/warehouse/mto_entry/mto_entry_add_row_edit_page/{id}', [
            'uses' => 'TMS\Warehouse\MtoEntryController@addRowEditPage',
            'as' => 'tms.warehouse.mto_entry_add_row_edit_page'
        ]);

        Route::post('/warehouse/mto_entry/voided_mto_data/{id}', [
            'uses' => 'TMS\Warehouse\MtoEntryController@voidedMtoData',
            'as' => 'tms.warehouse.mto-entry_voided_mto_data'
        ]);
        Route::get('/warehouse/mto_entry/{id}/report_pdf_mtodata', [
            'uses' => 'TMS\Warehouse\MtoEntryController@reportPdfMto',
            'as' => 'tms.warehouse.mto-entry_report_pdf_mtodata'
        ]);

        Route::post('/warehouse/mto_entry/posted_mto_data/{id}', [
            'uses' => 'TMS\Warehouse\MtoEntryController@postedMtoData',
            'as' => 'tms.warehouse.mto-entry_posted_mto_entry_data'
        ]);

        Route::get('/warehouse/mto_entry/{id}/view_mto_entry_log', [
            'uses' => 'TMS\Warehouse\MtoEntryController@viewLogMtoEntry',
            'as' => 'tms.warehouse.mto-view_mto_entry_log'
        ]);
        Route::get('/warehouse/mto_entry/{id}/mto_check_bom', [
            'uses' => 'TMS\Warehouse\MtoEntryController@checkBom',
            'as' => 'tms.warehouse.mto-mto_check_bom'
        ]);
        Route::get('/warehouse/mto_entry/{id}/mto_check_stclose', [
            'uses' => 'TMS\Warehouse\MtoEntryController@checkStClose',
            'as' => 'tms.warehouse.mto_check_stclose'
        ]);
        Route::get('/warehouse/mto_entry/{id}/check_validate_same_item_mto_entry', [
            'uses' => 'TMS\Warehouse\MtoEntryController@validateItemSameMtoEntry',
            'as' => 'tms.warehouse.mto-check_validate_same_item_mto_entry'
        ]);

        Route::get('/warehouse/mto_entry/{id}/mtoEntryEditDetailDatatables', [
            'uses' => 'TMS\Warehouse\MtoEntryController@mtoEntryEditDetailDatatables',
            'as' => 'tms.warehouse.mto-mto_entry_edit_detail_page_datatables'
        ]);

        Route::delete('/warehouse/mto_entry/mto_entry_delete_page_detail_edit/{id}', [
            'uses' => 'TMS\Warehouse\MtoEntryController@DestroyDeleteEditDetail',
            'as' => 'tms.warehouse.mto_entry_delete_page_detail_edit'
        ]);


        // 5. Stock Out Entry :: page ::
        Route::get('/warehouse/stock_out_entry', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@indexStockOutEntry',
            'as' => 'tms.warehouse.stock_out_entry'
        ]);

        Route::get('/warehouse/stock_out_entry/get_stock_out_datatables', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@GetStoutdatatablesDashboard',
            'as' => 'tms.warehouse.get_stock_out_datatables'
        ]);


        Route::get('/warehouse/stock_out_entry/get_choice_data_item_datatables', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@getChoiceDataItemDatatables',
            'as' => 'tms.warehouse.get_stock_out_get_choice_data_item_datatables'
        ]);

        Route::get('/warehouse/stock_out_entry/stock_out_select_warehouse', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@SysWarehouse',
            'as' => 'tms.warehouse.stock_out_entry.stock_out_select_warehouse'
        ]);

        Route::post('/warehouse/stock_out_entry/store_stout', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@storeStockOut',
            'as' => 'tms.warehouse.stock_out_entry_storeStockOut'
        ]);


        Route::get('/warehouse/stock_out_entry/{id}/show_view_stock_out_entry', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@showViewStout',
            'as' => 'tms.warehouse.show_view_stock_out_entry'
        ]);
        Route::get('/warehouse/stock_out_entry/{id}/stock_out_entry_edit', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@editStoutEntry',
            'as' => 'tms.warehouse.stock_out_entry_edit'
        ]);

        Route::post('/warehouse/stock_out_entry/stock_out_entry_void/{param}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@voidStoutEntry',
            'as' => 'tms.warehouse.stock_out_entry_void'
        ]);

        Route::post('/warehouse/stock_out_entry/stock_out_entry_post/{param}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@postStoutEntry',
            'as' => 'tms.warehouse.stock_out_entry_post'
        ]);

        Route::get('/warehouse/stock_out_entry/{id}/stock_out_entry_report', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@reportStoutEntry',
            'as' => 'tms.warehouse.stock_out_entry_report'
        ]);

        Route::get('/warehouse/stock_out_entry/{id}/stock_out_entry_log', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@logStoutEntry',
            'as' => 'tms.warehouse.stock_out_entry_log'
        ]);


        Route::get('/warehouse/stock_out_entry/{id}/stock_out_entry_edit_detail_page', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@editDetail',
            'as' => 'tms.warehouse.stock_out_entry_edit_detail_page'
        ]);
        Route::put('/warehouse/stock_out_entry/stock_out_entry_update_detail/{id}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@updateDetailStout',
            'as' => 'tms.warehouse.stock_out_entry_update_detail'
        ]);

        Route::put('/warehouse/stock_out_entry/stock_out_entry_update/{id}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@updateStout',
            'as' => 'tms.warehouse.stock_out_entry_update'
        ]);



        Route::put('/warehouse/stock_out_entry/stock_out_update_header/{id}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@updateHeaderEditPageStout',
            'as' => 'tms.warehouse.stock_out_update_header'
        ]);

        Route::delete('/warehouse/stock_out_entry/stock_out_delete_detail_page/{id}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@deleteDetailPageStout',
            'as' => 'tms.warehouse.stock_out_delete_detail_page'
        ]);

        Route::get('/warehouse/stock_out_entry/{id}/stock_out_dashboard_edit_detail', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@dashboardEditDetail',
            'as' => 'tms.warehouse.stock_out_dashboard_edit_detail'
        ]);
        Route::get('/warehouse/stock_out_entry/{id}/stock_out_validate_edit_detail_page', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@validateEditDetail',
            'as' => 'tms.warehouse.stock_out_validate_edit_detail_page'
        ]);
        Route::get('/warehouse/stock_out_entry/{id}/stock_out_check_stclose_', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@checkStClose',
            'as' => 'tms.warehouse.stock_out_check_stclose_'
        ]);

        Route::get('/warehouse/stock_out_entry/{id}/stock_out_view_restore_page', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@viewRestoreDelete',
            'as' => 'tms.warehouse.stock_out_stock_out_view_restore_page'
        ]);
        Route::get('/warehouse/stock_out_entry/stock_out_entry_restore_action/{id}', [
            'uses' => 'TMS\Warehouse\StockOutEntryController@StoutRestore',
            'as' => 'tms.warehouse.stock_out_entry_restore_action'
        ]);


         // Stock In Entry :: page ::
         Route::get('/warehouse/stock_in_entry', [
            'uses' => 'TMS\Warehouse\StockInEntryController@indexStockInEntry',
            'as' => 'tms.warehouse.stock_in_entry'
        ]);
        Route::get('/warehouse/stock_in_entry/get_stock_in_datatables', [
            'uses' => 'TMS\Warehouse\StockInEntryController@GetStindatatablesDashboard',
            'as' => 'tms.warehouse.get_stock_in_datatables'
        ]);
        Route::get('/warehouse/stock_in_entry/get_choice_data_item_datatables_stock_in', [
            'uses' => 'TMS\Warehouse\StockInEntryController@getChoiceDataItemDatatablesStin',
            'as' => 'tms.warehouse.get_choice_data_item_datatables_stock_in'
        ]);
        Route::get('/warehouse/stock_in_entry/stock_in_select_warehouse', [
            'uses' => 'TMS\Warehouse\StockInEntryController@SysWarehouseStin',
            'as' => 'tms.warehouse.stock_in_entry.stock_in_select_warehouse'
        ]);
        Route::post('/warehouse/stock_in_entry/store_stin', [
            'uses' => 'TMS\Warehouse\StockInEntryController@storeStockIn',
            'as' => 'tms.warehouse.stock_in_entry_storeStockIn'
        ]);
        Route::get('/warehouse/stock_in_entry/{id}/show_view_stock_in_entry', [
            'uses' => 'TMS\Warehouse\StockInEntryController@showViewStin',
            'as' => 'tms.warehouse.show_view_stock_in_entry'
        ]);
        Route::get('/warehouse/stock_in_entry/{id}/stock_in_entry_edit', [
            'uses' => 'TMS\Warehouse\StockInEntryController@editStinEntry',
            'as' => 'tms.warehouse.stock_in_entry_edit'
        ]);
        Route::get('/warehouse/stock_in_entry/{id}/stock_in_dashboard_edit_detail', [
            'uses' => 'TMS\Warehouse\StockInEntryController@dashboardEditDetailStin',
            'as' => 'tms.warehouse.stock_in_dashboard_edit_detail'
        ]);

        Route::put('/warehouse/stock_in_entry/stock_in_entry_update/{id}', [
            'uses' => 'TMS\Warehouse\StockInEntryController@updateStin',
            'as' => 'tms.warehouse.stock_in_entry_update'
        ]);
        Route::put('/warehouse/stock_in_entry/stock_in_update_header/{id}', [
            'uses' => 'TMS\Warehouse\StockInEntryController@updateHeaderEditPageStin',
            'as' => 'tms.warehouse.stock_in_update_header'
        ]);

        Route::get('/warehouse/stock_in_entry/{id}/stock_in_entry_edit_detail_page', [
            'uses' => 'TMS\Warehouse\StockInEntryController@editDetail',
            'as' => 'tms.warehouse.stock_in_entry_edit_detail_page'
        ]);
        Route::put('/warehouse/stock_in_entry/stock_in_entry_update_detail/{id}', [
            'uses' => 'TMS\Warehouse\StockInEntryController@updateDetailStin',
            'as' => 'tms.warehouse.stock_in_entry_update_detail'
        ]);
        Route::delete('/warehouse/stock_in_entry/stock_in_delete_detail_page/{id}', [
            'uses' => 'TMS\Warehouse\StockInEntryController@deleteDetailPageStin',
            'as' => 'tms.warehouse.stock_in_delete_detail_page'
        ]);
        Route::post('/warehouse/stock_in_entry/stock_in_entry_void/{param}', [
            'uses' => 'TMS\Warehouse\StockInEntryController@voidStinEntry',
            'as' => 'tms.warehouse.stock_in_entry_void'
        ]);
        Route::get('/warehouse/stock_in_entry/{id}/stock_in_entry_report', [
            'uses' => 'TMS\Warehouse\StockInEntryController@reportStinEntry',
            'as' => 'tms.warehouse.stock_in_entry_report'
        ]);
        Route::post('/warehouse/stock_in_entry/stock_in_entry_post/{param}', [
            'uses' => 'TMS\Warehouse\StockInEntryController@postStinEntry',
            'as' => 'tms.warehouse.stock_in_entry_post'
        ]);
        Route::get('/warehouse/stock_in_entry/{id}/stock_in_entry_log', [
            'uses' => 'TMS\Warehouse\StockInEntryController@logStinEntry',
            'as' => 'tms.warehouse.stock_in_entry_log'
        ]);
        Route::get('/warehouse/stock_in_entry/{id}/stock_in_check_stclose_', [
            'uses' => 'TMS\Warehouse\StockInEntryController@checkStClose',
            'as' => 'tms.warehouse.stock_in_check_stclose_'
        ]);


        /*
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |   MODUL MASTER VENDOR
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */

        Route::get('/master/vendor', ['uses' => 'TMS\Master\MasterVendorController@index', 'as' => 'tms.master.vendor']); //return index
        Route::get('/master/vendor/datavendor', ['uses' => 'TMS\Master\MasterVendorController@datavendor', 'as' => 'tms.master.vendor.getdata']); //getdatatable
        Route::post('/master/vendor/postdata', ['uses' => 'TMS\Master\MasterVendorController@postdata', 'as' => 'tms.master.vendor.postdata']);
        Route::post('/master/vendor/postdata_edit', ['uses' => 'TMS\Master\MasterVendorController@postdata_edit', 'as' => 'tms.master.vendor.postdata_edit']);
        Route::get('/master/vendor/{id}/editdata', ['uses' => 'TMS\Master\MasterVendorController@editdata', 'as' => 'tms.master.vendor.editdata']);
        Route::get('/master/vendor/getdata_ven', ['uses' => 'TMS\Master\MasterVendorController@getdata_ven', 'as' => 'tms.master.vendor.getdata_ven']);
        Route::delete('/master/vendor/delete/{id}', ['uses' => 'TMS\Master\MasterVendorController@deletedata', 'as' => 'tms.master.vendor.deletedata']);


         // 5. PPB Entry :: PAGE ::
       Route::get('/procurement/ppb_entry' , [
        'uses' => 'TMS\Procurement\PpbController@index' ,
        'as' => 'tms.procurement.ppb_entry'
        ]);

        Route::get('/procurement/ppb_entry/datatables', [
            'uses' => 'TMS\Procurement\PpbController@getPpbDatatables',
            'as' => 'tms.procurement.ppb_entry_datatables'
        ]);
        Route::get('/procurement/ppb_entry/datatable_choice_data', [
            'uses' => 'TMS\Procurement\PpbController@getPopUpChoiceDataDatatables',
            'as' => 'tms.procurement.ppb_entry_datatables_choice_data'
        ]);
        Route::post('/procurement/ppb_entry/store_data_ppb', [
            'uses' => 'TMS\Procurement\PpbController@StoreDataPPB',
            'as' => 'tms.procurement.ppb_entry_store_data_ppb'
        ]);
        Route::get('/procurement/ppb_entry/{id}/show_detail_view', [
            'uses' => 'TMS\Procurement\PpbController@show_view_detail_ppb',
            'as' => 'tms.procurement.ppb_entry_show_view_detail'
        ]);
        Route::post('/procurement/ppb_entry/stockidmodaladd', [
            'uses' => 'TMS\Procurement\PpbController@createdatastockid',
            'as' => 'tms.procurement.ppb_entry_createdatastockid'
        ]);
        Route::get('/procurement/ppb_entry/{id}/viewstockiddetail', [
            'uses' => 'TMS\Procurement\PpbController@show_view_stockId_ppb_no',
            'as' => 'tms.procurement.ppb_entry_show_view_stockId_ppb_no'
        ]);
        Route::get('/procurement/ppb_entry/edit_ppb_data/{id}', [
            'uses' => 'TMS\Procurement\PpbController@editDataPPB',
            'as' => 'tms.procurement.ppb_entry_edit_ppb_data'
        ]);

        Route::get('/procurement/ppb_entry/edit_ppb_itemdata/{id}', [
            'uses' => 'TMS\Procurement\PpbController@editTableItem',
            'as' => 'tms.procurement.ppb_entry_edit_ppb_item_data'
        ]);

        Route::get('/procurement/ppb_entry/{id}/dashboard_edit_ppb_itemdata', [
            'uses' => 'TMS\Procurement\PpbController@dashboardEditItemDetail',
            'as' => 'tms.procurement.ppb_entry_dashboard_edit_ppb_item_data'
        ]);

        Route::put('/procurement/ppb_entry/update_ppb_itemdata/{id}', [
            'uses' => 'TMS\Procurement\PpbController@updateItemPpb',
            'as' => 'tms.procurement.ppb_entry_update_ppb_itemdata'
        ]);

        Route::put('/procurement/ppb_entry/update_ppb_data/{id}', [
            'uses' => 'TMS\Procurement\PpbController@updatePpbEntry',
            'as' => 'tms.procurement.ppb_entry_update_ppb_data'
        ]);

        Route::put('/procurement/ppb_entry/update_header_ppb_editdata/{id}', [
            'uses' => 'TMS\Procurement\PpbController@updateHeaderEditPPB',
            'as' => 'tms.procurement.ppb_entry_update_header_editdata'
        ]);


        Route::delete('/procurement/ppb_entry/delete_item_ppb/{id}', [
            'uses' => 'TMS\Procurement\PpbController@deleteitempagePpb',
            'as' => 'tms.procurement.ppb_entry_delete_itemdata'
        ]);

        Route::post('/procurement/ppb_entry/voided_ppb_data/{id}', [
            'uses' => 'TMS\Procurement\PpbController@voidedPpbData',
            'as' => 'tms.procurement.ppb_entry_voided_ppb_data'
        ]);
        Route::get('/procurement/ppb_entry/{id}/report_ppb_data', [
            'uses' => 'TMS\Procurement\PpbController@reportPdfPpb',
            'as' => 'tms.procurement.ppb_entry_report_pdf_ppbdata'
        ]);

        Route::post('/procurement/ppb_entry/posted_ppb_data/{id}', [
            'uses' => 'TMS\Procurement\PpbController@postedPPbData',
            'as' => 'tms.procurement.ppb_entry_posted_ppb_entry_data'
        ]);

        Route::get('/procurement/ppb_entry/{id}/view_ppb_log_entry', [
            'uses' => 'TMS\Procurement\PpbController@viewLogPpbEntry',
            'as' => 'tms.procurement.ppb_view_log_ppb_entry'
        ]);

        Route::post('/procurement/ppb_entry/finish_ppb_data/{id}', [
            'uses' => 'TMS\Procurement\PpbController@finishPpbEntry',
            'as' => 'tms.procurement.ppb_entry_finish_ppb_data'
        ]);

        Route::get('/procurement/ppb_entry/{id}/cek_stclose_ppb', [
            'uses' => 'TMS\Procurement\PpbController@cekCloseMonth',
            'as' => 'tms.procurement.cek_stclosemonth_ppb'
        ]);

        Route::get('/procurement/ppb_entry/{id}/validate_ppb_edititemdata', [
            'uses' => 'TMS\Procurement\PpbController@validateEdititem',
            'as' => 'tms.procurement.validate_edit_ppb_itemdata'
        ]);

        // PO Entry :: PAGE ::
        Route::get('/procurement/po_entry' , [
            'uses' => 'TMS\Procurement\POController@index' ,
            'as' => 'tms.procurement.po_entry'
        ]);

        Route::get('/procurement/po_entry/datatables', [
            'uses' => 'TMS\Procurement\POController@getPoDatatables',
            'as' => 'tms.procurement.po_entry_datatables'
        ]);

        Route::get('/procurement/po_entry/datatable_choice_data', [
            'uses' => 'TMS\Procurement\POController@getPopUpItemDatatables',
            'as' => 'tms.procurement.po_entry_datatables_choicedata_item'
        ]);

        Route::get('/procurement/po_entry/datatable_choicedata_mastervendor', [
            'uses' => 'TMS\Procurement\POController@getPopupMasterVendor',
            'as' => 'tms.procurement.po_entry_datatables_choicedata_vendor'
        ]);

        Route::get('/procurement/po_entry/datatable_choicedata_ppbentry', [
            'uses' => 'TMS\Procurement\POController@getPopupPpbEntry',
            'as' => 'tms.procurement.po_entry_datatables_choicedata_ppbentry'
        ]);

        Route::get('/procurement/po_entry/{id}/report_po_data', [
            'uses' => 'TMS\Procurement\POController@reportPdfPO',
            'as' => 'tms.procurement.po_entry_report_pdf_datapo'
        ]);

        Route::post('/procurement/po_entry/store_data_ppb', [
            'uses' => 'TMS\Procurement\POController@StoreDataPPB',
            'as' => 'tms.procurement.po_entry_store_data_ppb'
        ]);

        Route::get('/procurement/po_entry/autocomplete_vendor', [
            'uses' => 'TMS\Procurement\POController@getVendorPo',
            'as' => 'tms.procurement.po_entry.autocomplete_vendorPo'
        ]);

        Route::get('/procurement/po_entry/get_poHeaderdata', [
            'uses' => 'TMS\Procurement\POController@getDataPoHeaderCreate',
            'as' => 'tms.procurement.po_entry.get_po_headerdata_create'
        ]);

        Route::get('/procurement/po_entry/get_poDetaildata', [
            'uses' => 'TMS\Procurement\POController@getDataPoDetailCreate',
            'as' => 'tms.procurement.po_entry.get_po_detaildata_create'
        ]);

        Route::get('/procurement/po_entry/{id}/po_check_ppb', [
            'uses' => 'TMS\Procurement\POController@checkPPBItem',
            'as' => 'tms.procurement.po_entry.po_check_ppb_item'
        ]);


         /*
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        |   RECEIVING GOODS ENTRY PAGE
        | +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        */
        //Accounting
            Route::get('/acc', 'Tms\Acc\AccCustomerController@index')->name('ar_Index');
            Route::post('/acc/delete','Tms\Acc\AccCustomerController@deleteSJ');
            Route::post('/acc','Tms\Acc\AccCustomerController@update');
            Route::post('/acc/add','Tms\Acc\AccCustomerController@create');
            Route::post('/acc/customer','Tms\Acc\AccCustomerController@getCustomer');
            Route::post('/acc/sj','Tms\Acc\AccCustomerController@getSJ');
            Route::post('/acc/doDtl','Tms\Acc\AccCustomerController@getDoDtl');

            Route::get('/ttf_entry','TMS\Acc\TtfEntryController@index')->name('ttf_Index');;

        Route::get('/procurement/rg_entry', [
            'uses' => 'TMS\Procurement\RG_EntryController@indexRG_Entry',
            'as' => 'tms.procurement.rg_entry'
            ]);
        Route::get('/procurement/rg_entry/rg_data', [
            'uses' => 'TMS\Procurement\RG_EntryController@getDataRG',
            'as' => 'tms.procurement.rg_data'
            ]);
        Route::get('/procurement/rg_entry/get_choice_dataitem', [
            'uses' => 'TMS\Procurement\RG_EntryController@getChoiceDataItem',
            'as' => 'tms.procurement.choice_dataitem'
            ]);
        Route::get('/procurement/rg_entry/sys_warehouse', [
            'uses' => 'TMS\Procurement\RG_EntryController@sysWarehouse',
            'as' => 'tms.procurement.sys_warehouse'
            ]);
        Route::get('/procurement/rg_entry/entry_rg', [
            'uses' => 'TMS\Procurement\RG_EntryController@entryRG',
            'as' => 'tms.procurement.entry_rg'
            ]);
        Route::get('/procurement/rg_entry/{id}/view_rg', [
            'uses' => 'TMS\Procurement\RG_EntryController@showViewRG',
            'as' => 'tms.procurement.view_rg'
            ]);
        Route::get('/procurement/rg_entry/{id}/edit_rg', [
            'uses' => 'TMS\Procurement\RG_EntryController@edit_RG',
            'as' => 'tms.procurement.edit_rg'
            ]);
        Route::get('/procurement/rg_entry/{id}/edit_detail_rg', [
            'uses' => 'TMS\Procurement\RG_EntryController@edit_RGdetail',
            'as' => 'tms.procurement.edit_rg-detail'
            ]);
        Route::post('/procurement/rg_entry/void_rg/{param}', [
            'uses' => 'TMS\Procurement\RG_EntryController@void_RG',
            'as' => 'tms.procurement.void_rg'
            ]);
        Route::get('/procurement/rg_entry/{id}/log_rg', [
            'uses' => 'TMS\Procurement\RG_EntryController@viewlog_RG',
            'as' => 'tms.procurement.view_log_rg'
        ]);
        Route::get('/procurement/rg_entry/rg_vendor', [
            'uses' => 'TMS\Procurement\RG_EntryController@getVendor_RG',
            'as' => 'tms.procurement.select_vendor_rg'
        ]);
        Route::get('/procurement/rg_rntry/get_data_po', [
            'uses' => 'TMS\Procurement\RG_EntryController@getlistPO_rg',
            'as' => 'tms.procurement.select_po_rg'
        ]);
        Route::get('/procurement/rg_entry/check_ponum', [
            'uses' => 'TMS\Procurement\RG_EntryController@checkPO_rg',
            'as' => 'tms.procurement.check_ponum'
        ]);




    });

    //PREFIX:: AR

});

