<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function getService()
    {
        $service=Service::all();
        return response()->json(['service'=>$service],200);
    }

    public function createService(Request $request)
    {
        $data=$request->all();
        $service= new Service();
        $service->service_name=$data['service_name'];
        $service->service_price=$data['service_price'];
        $service->service_models_id=$data['service_models_id'];
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
    public function loadServiceByModels($id=null)
    {
        $service=Service::where('service_models_id','=',$id)->get();
        return response()->json(['serviceTypes'=>$service],200);
    }
    public function loadServiceByModelsBrand($brandId=null,$modelId=null)
    {
//        $service=Service::where('service_models_id','=',$modelId)->Orwhere('service_brand_id','=',$brandId)->get();
        $sql='select * from service where service_models_id='."$modelId".' AND service_brand_id='."$brandId";
        $result = DB::select(DB::raw($sql));
        return response()->json(['serviceTypes'=>$result],200);
    }

    public function loadServiceTypesDetails(Request $request)
    {
        $data=$request->all();
        $type=array();
        for($x=0; $x<count($data); $x++)
        {
            $type[$x]=ServiceType::find($data[$x]);
        }

        return response()->json(["types"=>$type],200);
    }
}
