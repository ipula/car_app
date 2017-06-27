<?php

namespace App\Http\Controllers;

use App\JobCard;
use App\JobCardDetail;
use Illuminate\Http\Request;

class JobCardController extends Controller
{
    public function getAllJobCards()
    {
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser'])->get();
        return response()->json(["job"=>$job],200);
    }
    public function getUsersJobCards($id=null)
    {
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser'])->where('job_card_users_id','=',$id)->get();
        return response()->json(["job"=>$job],200);
    }
    public function createJobCard(Request $request)
    {
        $success=false;
        $data=$request->all();

        $jobCard=new JobCard();

        $jobCard->job_card_vehicle_id=$data['job_card_vehicle_id'];
        $jobCard->job_card_users_id=$data['job_card_users_id'];
        $jobCard->job_card_total=$data['job_card_total'];
        $jobCard->job_card_status=0;
        $jobCard->save();

        if($jobCard->save())
        {
            for($x=0; $x<count($data['addedDetail']); $x++)
            {
                $jobCardDetail=new JobCardDetail();
                $jobCardDetail->job_card_detail_job_card_id=JobCard::max('job_card_id');
                $jobCardDetail->job_card_detail_technician_id=$data['addedDetail'][$x]['job_card_detail_technician_id'];
                $jobCardDetail->job_card_detail_service_id=$data['addedDetail'][$x]['job_card_detail_service_id'];
                $jobCardDetail->job_card_detail_service_type_id=$data['addedDetail'][$x]['job_card_detail_service_type_id'];
                $jobCardDetail->job_card_detail_comment=$data['addedDetail'][$x]['job_card_detail_comment'];
                $jobCardDetail->job_card_detail_status=0;
                $jobCardDetail->job_card_detail_quantity=$data['addedDetail'][$x]['job_card_detail_quantity'];
                $jobCardDetail->job_card_detail_unit_price=$data['addedDetail'][$x]['job_card_detail_unit_price'];
                $success=$jobCardDetail->save();

            }
            if($success)
            {
                return response()->json(["msg"=>"New Job Card Created"],200);
            }
            else
            {
                return response()->json(["msg"=>"New Job Card Created Failed"],500);
            }

        }
        else
        {
            return response()->json(["msg"=>"New Job Card Created Failed"],500);
        }
    }

    public function loadJobCard($id=null)
    {
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser','getJobCardDetails.getTechnician','getJobCardDetails.getService','getJobCardDetails.getServiceType'])->find($id);
        return response()->json(["job"=>$job],200);
    }

    public function editJobDetails($id=null,Request $request)
    {
        $onGoing=JobCard::find($id);
        $onGoing->job_card_status=1;
        $onGoing->save();
        if($onGoing->save())
        {
            $job=JobCardDetail::where('job_card_detail_job_card_id','=',$id)->first();
            $data=$request->all();

            $job->job_card_detail_technician_id=$data['technician_id'];
            $job->job_card_detail_comment=$data['job_card_detail_comment'];
            $job->job_card_detail_status=$data['job_card_detail_status'];
            $job->job_card_detail_quantity=$data['job_card_detail_quantity'];
            $job->save();

            if($job->save())
            {
                return response()->json(["msg"=>"Job Updated"],500);
            }
            else
            {
                return response()->json(["msg"=>"Job Update Failed"],500);
            }
        }
        else
        {
            return response()->json(["msg"=>"Job Update Failed"],500);
        }


    }

    public function completeJobCard($id=null)
    {
        $job=JobCard::find($id);
        $job->job_card_status=2;
        $job->save();

        if($job->save())
        {
            return response()->json(["msg"=>"Job Card Complete"],500);
        }
        else
        {
            return response()->json(["msg"=>"Job Card Complete Failed"],500);
        }
    }
}
