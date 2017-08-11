<?php

namespace App\Http\Controllers;

use App\Mail\Account;
use App\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TechnicianController extends Controller
{
    public function getTechnician(Request $requestp)
    {
        if(isset($request['page']) && $request['page']!=0){
            $technician=Technician::paginate(10);
        }
        else
        {
            $technician=Technician::all();
        }
        return response()->json(["technician"=>$technician],200);
    }

    public function createTechnician(Request $request)
    {
        $data=$request->all();

        $technician=new Technician();
        $technician->technician_name=$data['technician_name'];
        $technician->technician_tel1=$data['technician_tel1'];
        $technician->technician_tel2=$data['technician_tel2'];
        $technician->technician_address=$data['technician_address'];
        $technician->technician_code=$data['technician_code'];
        $technician->save();

        if($technician->save())
        {
//            Mail::to('ipularanasinghe007@gmail.com')->send(new Account);
//            $data = []; // Empty array
//            Mail::send('email',$data, function($message) {
//                $message->to('ipularanasinghe007@gmail.com');
////                $message->subject('Mailgun Testing');
//            });
            return response()->json(["msg"=>"New Technician Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"New Technician Created Failed"],500);
        }
    }

    public function editTechnician($id=null,Request $request)
    {
        $technician=Technician::find($id);
        $data=$request->all();

        $technician->technician_name=$data['technician_name'];
        $technician->technician_tel1=$data['technician_tel1'];
        $technician->technician_tel2=$data['technician_tel2'];
        $technician->technician_address=$data['technician_address'];
        $technician->technician_code=$data['technician_code'];
        $technician->save();

        if($technician->save())
        {
            return response()->json(["msg"=>"Technician Updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"Technician Updated Failed"],500);
        }
    }

    public function loadTechnician($id=null)
    {
        $technician=Technician::find($id);
        return response()->json(["technician"=>$technician],200);
    }

    public function searchTechnician($name=null)
    {
        $technician=Technician::where('technician_name','LIKE', '%' . $name . '%')->get();
        return response()->json(["technician"=>$technician],200);
    }
}
