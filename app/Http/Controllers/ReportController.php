<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function getAgentDueAmount(Request $request)
    {
        $data=$request->all();
        $id=$data['id'];
        $dateFrom=$data['dateFrom'];
        $dateTo=$data['dateTo'];

        date_default_timezone_set("Asia/Colombo");


        if($dateFrom=="null" && $dateFrom=="null" && $id=="null")
        {
            $dateFrom=date('Y-m-d',strtotime( date('Y-m-d') . ' -1 day' ));;
            $dateTo=date('Y-m-d');
            $amount="SELECT * FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id INNER JOIN agent on vehicle_agent_id=agent_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }
        else
        {
            $amount="SELECT * FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id INNER JOIN agent on vehicle_agent_id=agent_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'"." AND agent_id="."$id";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }


    }
}
