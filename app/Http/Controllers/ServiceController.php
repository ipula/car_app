<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Models;
use App\ModelServicePrice;
use App\Service;
use App\ServiceService;
use App\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    ///changed...........
    public function getService()
    {
        $service=ModelServicePrice::with(['getModels','getService'])->get();
        return response()->json(['service'=>$service],200);
    }
//changed...
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

        $service=new ServiceService();
        $service->service_service_service_id=$data['service_id'];
        $service->service_service_type_id=$data['service_type_id'];
        $success=$service->save();

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
        $data=array();
        $service=ServiceService::where('service_service_service_id','=',$id)->get();

        for($x=0; $x< count($service); $x++)
        {
            $data[$x]=Service::where('service_id','=',$service[$x]['service_service_type_id'])->get();

        }

        return response()->json(['serviceTypes'=>$data],200);
    }
    public function loadServiceByModels($id=null)
    {
        $service=ModelServicePrice::where('model_service_price_model_id','=',$id)->get();
        return response()->json(['serviceTypes'=>$service],200);
    }
    public function loadServiceByModelsBrand($modelId=null)
    {
        $service=ModelServicePrice::with(['getService'])->where('model_service_price_model_id','=',$modelId)->get();
        return response()->json(['serviceTypes'=>$service],200);
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
//
    public function loadService($id=null)
    {
        $service=ModelServicePrice::with(['getModels','getService'])->find($id);
        return response()->json(["service"=>$service],200);
    }

    public function loadEditServiceTypes($id=null)
    {
        $types=ServiceType::find($id);
        return response()->json(["types"=>$types],200);
    }

    public function editServiceType($id=null,Request $request)
    {
        $data=$request->all();
        $success=false;

        $serviceTypes=ServiceType::find($id);
        $serviceTypes->service_type_name=$data['service_type_name'];
        $serviceTypes->service_type_price=$data['service_type_price'];
        $success=$serviceTypes->save();

        if($success)
        {
            return response()->json(["msg"=>" Service Type Updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service Type Updated Failed"],500);
        }
    }
//changed........................
    public function addPrice(Request $request)
    {
        $data=$request->all();

        $service=new Service();
        $service->service_name=$data['service_name'];
        $service->service_category=$data['service_category'];
        $service->save();

        $modelServicePrice=new ModelServicePrice();
        $modelServicePrice->model_service_price_model_id=$data['service_models_id'];
        $modelServicePrice->model_service_price_service_id=Service::max('service_id');
        $modelServicePrice->model_service_price=$data['service_price'];
        $modelServicePrice->save();
        if($modelServicePrice->save())
        {
            return response()->json(["msg"=>" Service Price Added"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service Price Added Failed"],500);
        }
    }
    //changed........................
    public function addEditPrice($id=null,Request $request)
    {
        $data=$request->all();
        $modelServicePrice=ModelServicePrice::find($id);
        $modelServicePrice->model_service_price=$data['model_service_price'];
        $modelServicePrice->save();
        if($modelServicePrice->save())
        {
            $service=Service::find($data['get_service']['service_id']);
            $service->service_name=$data['get_service']['service_name'];
            $service->service_category=$data['get_service']['service_category'];
            $service->save();
            return response()->json(["msg"=>" Service updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"Service updated Failed"],500);
        }
    }

    public function totalServiceIncome()
    {
        $total='select sum(invoice_total-((invoice_total*invoice_discount_rate)/100)) as invoice_total, invoice_date from invoice group by invoice_date DESC LIMIT 8';
        $result = DB::select(DB::raw($total));

        $data=array(array());
        for ($x=0; $x<count($result); $x++)
        {
            $data[$x]['name']=$result[$x]->invoice_date;
            $data[$x]['value']=(double)$result[$x]->invoice_total;
        }
        return response()->json($data,200);
    }

}
