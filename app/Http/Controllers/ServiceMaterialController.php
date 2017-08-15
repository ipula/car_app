<?php

namespace App\Http\Controllers;

use App\ServiceMaterial;
use Illuminate\Http\Request;

class ServiceMaterialController extends Controller
{
    public function getMaterial()
    {
        $material=ServiceMaterial::all();
        return response()->json(["material"=>$material],200);
    }

    public function addServiceMaterial(Request $request)
    {
        $data=$request->all();

        $material=new ServiceMaterial();
        $material->service_material_name=$data['service_material_name'];
        $material->service_material_unit=$data['service_material_unit'];
        $material->service_material_unit_price=$data['service_material_unit_price'];
        $material->service_material_low_qty=$data['service_material_low_qty'];
        $material->service_material_max_qty=$data['service_material_max_qty'];
        $material->service_material_reorder_level=$data['service_material_reorder_level'];
        $material->save();


        if($material->save())
        {
            return response()->json(["msg"=>"Service Material created"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service Material created Failed"],500);
        }
    }

    public function loadServiceMaterial($id=null)
    {
        $serviceMaterial=ServiceMaterial::find($id);
        return response()->json(["material"=>$serviceMaterial],200);
    }

    public function editServiceMaterial($id=null,Request $request)
    {
        $data=$request->all();

        $material=ServiceMaterial::find($id);
        $material->service_material_name=$data['service_material_name'];
        $material->service_material_unit=$data['service_material_unit'];
        $material->service_material_unit_price=$data['service_material_unit_price'];
        $material->service_material_low_qty=$data['service_material_low_qty'];
        $material->service_material_max_qty=$data['service_material_max_qty'];
        $material->service_material_reorder_level=$data['service_material_reorder_level'];
        $material->save();


        if($material->save())
        {
            return response()->json(["msg"=>"Service Material Updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service Material Updated Failed"],500);
        }
    }

    public function searchServiceMaterial($name=null)
    {
        $material=ServiceMaterial::where('service_material_name','LIKE', '%' . $name . '%')->get();
        return response()->json(["material"=>$material],200);

    }
    public function searchServiceMaterialByCode($code=null)
    {
        $material=ServiceMaterial::where('service_material_code','LIKE', '%' . $code . '%')->get();
        return response()->json(["material"=>$material],200);

    }
}
