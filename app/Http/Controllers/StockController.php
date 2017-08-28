<?php

namespace App\Http\Controllers;

use App\CurrentStock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getStock()
    {
        $stock=CurrentStock::orderBy('service_material_id','desc')->paginate(10);
        return response()->json(["stock"=>$stock],200);
    }
    public function getAllStock()
    {
        $stock=CurrentStock::orderBy('service_material_id','desc')->get();
        return response()->json(["stock"=>$stock],200);
    }

    public function getLowStock()
    {
        $stock=CurrentStock::where('stock_qty','<=','service_material_low_qty')->paginate(10);
        return response()->json(["stock"=>$stock],200);
    }

    public function getItemStock()
    {
        $stock=CurrentStock::where('stock_qty','>',0)->get();
        return response()->json(["stock"=>$stock],200);
    }

    public function getItemStockSearch($name=null)
    {
        $stock=CurrentStock::where('service_material_name','LIKE','%'.$name.'%')->where('stock_qty','>',0)->get();
        return response()->json(["stock"=>$stock],200);
    }

    public function searchStock($name=null)
    {
        $stock=CurrentStock::where('service_material_name','LIKE','%'.$name.'%')->orderBy('service_material_id','desc')->paginate(10);
        return response()->json(["stock"=>$stock],200);
    }
    public function searchLowStock($name=null)
    {
        $stock=CurrentStock::where('service_material_name','LIKE','%'.$name.'%')->where('stock_qty','<=','service_material_low_qty')->paginate(10);
        return response()->json(["stock"=>$stock],200);
    }
}
