<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\JobCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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

            $amount="SELECT SUM(service_material_unit_price*service_material_detail_qty) as sumOf,invoice_date,job_card_id,agent_name,vehicle_no,job_card_total,agent_discount FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id INNER JOIN agent on vehicle_agent_id=agent_id inner join service_material_detail on job_card_id=service_material_detail_job_card_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'"."group by job_card_id";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }
        else if($dateFrom!="null" && $dateFrom!="null" && $id=="null")
        {
            $amount="SELECT SUM(service_material_unit_price*service_material_detail_qty) as sumOf,invoice_date,job_card_id,agent_name,vehicle_no,job_card_total,agent_discount FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id INNER JOIN agent on vehicle_agent_id=agent_id inner join service_material_detail on job_card_id=service_material_detail_job_card_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'"."group by job_card_id";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }
        else
        {
            $amount="SELECT SUM(service_material_unit_price*service_material_detail_qty) as sumOf,invoice_date,job_card_id,agent_name,vehicle_no,job_card_total,agent_discount FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id INNER JOIN agent on vehicle_agent_id=agent_id inner join service_material_detail on job_card_id=service_material_detail_job_card_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'"." AND agent_id="."$id"." group by job_card_id";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }

    }

    public function sales(Request $request)
    {
        $data=$request->all();
        $dateFrom=$data['dateFrom'];
        $dateTo=$data['dateTo'];
        date_default_timezone_set("Asia/Colombo");

        if($dateFrom=="null" && $dateTo=="null")
        {
            $dateFrom=date('Y-m-d',strtotime( date('Y-m-d') . ' -1 day' ));;
            $dateTo=date('Y-m-d');

            $amount="SELECT * FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }
        else
        {
            $amount="SELECT * FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id
                  where invoice_date between "."'$dateFrom'"." and "."'$dateTo'";
            $result=DB::select(DB::raw($amount));
            return response()->json(["amount"=>$result,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }
    }

    public function dayEndSummary()
    {
        date_default_timezone_set("Asia/Colombo");
        $dateTo=date('Y-m-d');
        $amount="SELECT * FROM invoice INNER JOIN job_card on invoice_job_card_id=job_card_id inner join vehicle on job_card_vehicle_id=vehicle_id 
                  where invoice_date="."'$dateTo'";
        $result=DB::select(DB::raw($amount));
        return response()->json(["amount"=>$result,"dateTo"=>$dateTo],200);
    }

    public function customerHistory(Request $request)
    {
        $data=$request->all();
        date_default_timezone_set("Asia/Colombo");
        $dateFrom=$data['dateFrom'];
        $dateTo=$data['dateTo'];
        $id=$data['id'];
        if($dateFrom=="null" && $dateTo=="null" && $id=='null') {

            $dateFrom=date('Y-m-d',strtotime( date('Y-m-d') . ' -1 day' ));;
            $dateTo=date('Y-m-d');
//            $invoice=[];
            $invoice = Invoice::with(['getJobCard.getVehicle.getAgent', 'getJobCard.getUser', 'getJobCard.getJobCardDetails.getTechnician', 'getJobCard.getJobCardDetails.getService', 'getJobCard.getJobCardDetails.getTechnician', 'getJobCard.getJobCardDetails.getServiceType', 'getJobCard.getJobCardMaterial.getMaterial', 'getUsers'])->whereBetween('invoice_date',[$dateFrom,$dateTo])->get();
            return response()->json(['invoice' => $invoice,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);
        }
        else
        {

            $invoice=Invoice::with(['getJobCard.getVehicle.getAgent', 'getJobCard.getUser', 'getJobCard.getJobCardDetails.getTechnician', 'getJobCard.getJobCardDetails.getService', 'getJobCard.getJobCardDetails.getTechnician', 'getJobCard.getJobCardDetails.getServiceType', 'getJobCard.getJobCardMaterial.getMaterial', 'getUsers'])->whereHas('getJobCard', function($q) use($id)
                {
                    $numb = $id;
                    $q->where('job_card_vehicle_id','=',$numb);

                })->get();

                return response()->json(['invoice' => $invoice,"dateFrom"=>$dateFrom,"dateTo"=>$dateTo],200);

        }
    }
}
