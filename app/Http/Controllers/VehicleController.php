<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getVehicle()
    {
        $vehicle=Vehicle::with(['getBrand','getModel'])->get();
        return response()->json(["vehicle"=>$vehicle],200);
    }

    public function createVehicle(Request $request)
    {
        $data=$request->all();

        $vehicle=new Vehicle();
        $vehicle->vehicle_cust_name=$data['vehicle_cust_name'];
        $vehicle->vehicle_no=$data['vehicle_no'];
        $vehicle->vehicle_cust_tel1=$data['vehicle_cust_tel1'];
        $vehicle->vehicle_cust_tel2=$data['vehicle_cust_tel2'];
        $vehicle->vehicle_cust_address=$data['vehicle_cust_address'];
        $vehicle->vehicle_engine_no=$data['vehicle_engine_no'];
        $vehicle->vehicle_chassis_no=$data['vehicle_chassis_no'];
        $vehicle->vehicle_vehicle_models_id=$data['vehicle_vehicle_models_id'];
        $vehicle->vehicle_vehicle_brand_id=$data['vehicle_vehicle_brand_id'];
        $vehicle->save();

        if($vehicle->save())
        {
            return response()->json(["msg"=>"New Vehicle Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"New Vehicle Created Failed"],500);
        }
    }

    public function editVehicle($id=null,Request $request)
    {
        $vehicle=Vehicle::find($id);
        $data=$request->all();

        $vehicle->vehicle_cust_name=$data['vehicle_cust_name'];
        $vehicle->vehicle_no=$data['vehicle_no'];
        $vehicle->vehicle_cust_tel1=$data['vehicle_cust_tel1'];
        $vehicle->vehicle_cust_tel2=$data['vehicle_cust_tel2'];
        $vehicle->vehicle_cust_address=$data['vehicle_cust_address'];
        $vehicle->vehicle_engine_no=$data['vehicle_engine_no'];
        $vehicle->vehicle_chassis_no=$data['vehicle_chassis_no'];
        $vehicle->vehicle_vehicle_models_id=$data['vehicle_vehicle_models_id'];
        $vehicle->vehicle_vehicle_brand_id=$data['vehicle_vehicle_brand_id'];
        $vehicle->save();


        if($vehicle->save())
        {
            return response()->json(["msg"=>"Vehicle Updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"Vehicle Created Failed"],500);
        }
    }

    public function loadVehicle($id=null)
    {
        $vehicle=Vehicle::with(['getBrand','getModel'])->find($id);
        return response()->json(["vehicle"=>$vehicle],200);
    }
}
