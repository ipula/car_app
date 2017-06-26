<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getService()
    {
        $service=Service::all();
        return response()->json(['brand'=>$service],200);
    }

    public function createService(Request $request)
    {
        $data=$request->all();
        $service= new Service();
        $service->service_name=$data['service_name'];
        $service->service_price=$data['service_price'];
        $service->save();

        if($service->save())
        {
            return response()->json(["msg"=>"New Service Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"New Service Created Failed"],500);
        }

    }

    public function editService($id=null,Request $request)
    {
        $data=$request->all();
        $service=Service::find($id);
        $service->service_name=$data['service_name'];
        $service->service_price=$data['service_price'];
        $service->save();

        if($service->save())
        {
            return response()->json(["msg"=>"Service Edited"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service Edited Failed"],500);
        }

    }

    public function createServiceType(Request $request)
    {
        $data=$request->all();
        $success=false;

        $service=Service::find($data['service_id']);

        for($x=0; $x<count($data['addedServiceTypes']); $x++)
        {
            $serviceTypes=new ServiceType();
            $serviceTypes->service_type_name=$data['addedServiceTypes'][$x]['service_type_name'];
            $serviceTypes->service_type_price=$data['addedServiceTypes'][$x]['service_type_price'];
            $success=$serviceTypes->save();
            if($serviceTypes->save())
            {
                $service->getServiceTypes()->attach(ServiceType::max('service_type_id'));
            }
        }

        if($success)
        {
            return response()->json(["msg"=>" Service Type Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service Type Created Failed"],500);
        }

    }

    public function loadServiceTypes($id=null)
    {
        $service=Service::find($id)->getServiceTypes()->get();
        return response()->json(['serviceTypes'=>$service],200);
    }
}