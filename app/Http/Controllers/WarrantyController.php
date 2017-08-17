<?php

namespace App\Http\Controllers;

use App\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function getWarranty()
    {
        $warranty=Warranty::with(['getVehicle'])->paginate(10);
        return response()->json(["warranty"=>$warranty],200);
    }

    public function createWarranty(Request $request)
    {
        $data=$request->all();

        date_default_timezone_set("Asia/Colombo");

        $newWarranty=new Warranty();
        $newWarranty->warranty_date=date('Y-m-d');
        $newWarranty->warranty_time=date('H:i:s');
        $newWarranty->warranty_vehicle_id=$data['warranty_vehicle_id'];
        $newWarranty->save();

        if($newWarranty->save())
        {
            return response()->json(["msg"=>"Warranty created"],200);
        }
        else
        {
            return response()->json(["msg"=>"Warranty created Failed"],500);
        }
    }


    public function searchByVehicle($no=null)
    {
        $warranty=Warranty::with(['getVehicle'])->whereHas('getVehicle', function($q) use($no)
        {
            $numb = $no;
            $q->where('vehicle_no','LIKE', '%' . $numb . '%');

        })->paginate(10);
        return response()->json(["warranty"=>$warranty],200);
    }

}
