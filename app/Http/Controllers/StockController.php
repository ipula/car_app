<?php

namespace App\Http\Controllers;

use App\CurrentStock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getStock()
    {
        $stock=CurrentStock::all();
        return response()->json(["stock"=>$stock],200);
    }

    public function getLowStock()
    {
        $stock=CurrentStock::where('service_material_low_qty','>','stock_qty')->get();
        return response()->json(["stock"=>$stock],200);
    }

    public function searchStock($name)
    {
        $stock=CurrentStock::where('service_material_name','LIKE','%'.$name.'%')->get();
        return response()->json(["stock"=>$stock],200);
    }
}
