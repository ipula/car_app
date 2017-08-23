<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Models;
use Illuminate\Http\Request;

class BrandModelController extends Controller
{
    public function getBrand()
    {
        $brand=Brand::all();
        return response()->json(['brand'=>$brand],200);
    }

    public function createBrand(Request $request)
    {
        $data=$request->all();
        $brand= new Brand();
        $brand->brand_name=$data['brand_name'];
        $brand->save();

        if($brand->save())
        {
            return response()->json(["msg"=>"New Brand Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"New Brand Failed"],500);
        }

    }

    public function editBrand($id=null,Request $request)
    {
        $data=$request->all();
        $brand=Brand::find($id);
        $brand->brand_name=$data['brand_name'];
        $brand->save();

        if($brand->save())
        {
            return response()->json(["msg"=>" Brand Updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"Brand Update Failed"],500);
        }

    }

    public function createModels(Request $request)
    {
        $data=$request->all();
        $success=false;

            $models=new Models();
            $models->models_name=$data['models_name'];
            $success=$models->save();

        if($success)
        {
            return response()->json(["msg"=>" Vehicle Type Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"Vehicle Type Create Failed"],500);
        }

    }

    public function loadModels()
    {
        $type=Models::all();
        return response()->json(["types"=>$type],200);
    }
}
