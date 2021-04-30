<?php

namespace App\Models\Ekanban;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock_Balance extends Model
{
    protected $connection = 'ekanban';

    static function getBalance($date, $itemcode){
        return $query = DB::connection('ekanban')
                            ->select("SELECT func_get_last_balance('$date', '$itemcode') AS balance");
    }

    static function getItemStatus($period, $itemcode){
        return $query = DB::connection('ekanban')
                            ->select('CALL proc_fg_item_status(?, ?)', array($period, $itemcode));
    }

    static function getStockCard($period, $itemcode){
        return $query = DB::connection('ekanban')
                            ->select('CALL proc_fg_stock_transaction(?, ?)', array($period, $itemcode));
    }
}
