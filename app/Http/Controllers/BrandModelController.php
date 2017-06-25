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
//            $models=new Models();
//            $models->model_name=$data['model_name'];
//            $models->save();
//
//            if($models->save())
//            {
//
//            }

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

        $brand=Brand::find($data['brand_id']);

        for($x=0; $x<count($data['addedModels']); $x++)
        {
            $models=new Models();
            $models->models_name=$data['addedModels'][$x]['models_name'];
            $models->save();
            if($models->save())
            {
                $brand->getModels()->attach(Models::max('models_id'));
            }
        }


    }
}
