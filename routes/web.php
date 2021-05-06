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



    });
});
