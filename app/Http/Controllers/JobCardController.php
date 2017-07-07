<?php

namespace App\Http\Controllers;

use App\JobCard;
use App\JobCardDetail;
use App\ServiceMaterialDetail;
use App\TechnicianDetail;
use Illuminate\Http\Request;

class JobCardController extends Controller
{
    public function getAllJobCards()
    {
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser','getJobCardMaterial.getMaterial','getJobCardDetails.getService','getJobCardDetails.getServiceType','getJobCardDetails.getTechnician.techData'])->get();
        return response()->json(["job"=>$job],200);
    }
    public function getUsersJobCards($id=null)
    {
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser'])->where('job_card_users_id','=',$id)->get();
        return response()->json(["job"=>$job],200);
    }
    public function loadJobCardByVehicle($id=null)
    {
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser'])->where('job_card_vehicle_id','=',$id)->where('job_card_status','=',2)->get();
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
                $jobCardDetail->job_card_detail_service_id=$data['addedDetail'][$x]['job_card_detail_service_id'];
                $jobCardDetail->job_card_detail_service_type_id=$data['addedDetail'][$x]['job_card_detail_service_type_id'];
                $jobCardDetail->job_card_detail_comment=$data['addedDetail'][$x]['job_card_detail_comment'];
                $jobCardDetail->job_card_detail_status=0;
                $jobCardDetail->job_card_detail_quantity=$data['addedDetail'][$x]['job_card_detail_quantity'];
                $jobCardDetail->job_card_detail_unit_price=$data['addedDetail'][$x]['job_card_detail_unit_price'];
                $success=$jobCardDetail->save();
                if($success)
                    for($y=0; $y<count($data['addedDetail'][$x]['technician']); $y++)
                    {
                        $tecDetail=new TechnicianDetail();
                        $tecDetail->technician_detail_job_card_detail_id=JobCardDetail::max('job_card_detail_id');
                        $tecDetail->technician_detail_technician_id=$data['addedDetail'][$x]['technician'][$y]['technician_id'];
                        $tecDetail->save();

                    }

            }
            for($y=0; $y<count($data['materials']); $y++)
            {

                $material=new ServiceMaterialDetail();
                $material->service_material_detail_service_material_id=$data['materials'][$y]['service_material_id'];
                $material->service_material_detail_job_card_id=JobCard::max('job_card_id');
                $material->service_material_unit_price=$data['materials'][$y]['service_material_unit_price'];
                $material->service_material_detail_qty=$data['materials'][$y]['service_material_detail_qty'];
                $material->save();

            }

            if($success)
            {
                return response()->json(["msg"=>"New Job Card Created","success"=>"true"],200);
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
        $job=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser','getJobCardMaterial.getMaterial','getJobCardDetails.getService','getJobCardDetails.getServiceType','getJobCardDetails.getTechnician.techData'])->find($id);
        return response()->json(["job"=>$job],200);
    }

    public function editJobDetails($id=null,Request $request)
    {
        $data=$request->all();
        $onGoing=JobCard::find($id);
        $onGoing->job_card_status=1;
        $onGoing->save();
        if($onGoing->save())
        {

            for($x=0; $x<count($data['addedDetail']); $x++)
            {
                $jobCardDetail=JobCardDetail::find($data['addedDetail'][$x]['job_card_detail_id']);
                $jobCardDetail->job_card_detail_service_id=$data['addedDetail'][$x]['job_card_detail_service_id'];
                $jobCardDetail->job_card_detail_service_type_id=$data['addedDetail'][$x]['job_card_detail_service_type_id'];
                $jobCardDetail->job_card_detail_comment=$data['addedDetail'][$x]['job_card_detail_comment'];
                $jobCardDetail->job_card_detail_status=$data['addedDetail'][$x]['job_card_detail_status'];
                $jobCardDetail->job_card_detail_quantity=$data['addedDetail'][$x]['job_card_detail_quantity'];
                $jobCardDetail->job_card_detail_unit_price=$data['addedDetail'][$x]['job_card_detail_unit_price'];
                $success=$jobCardDetail->save();

                if($jobCardDetail->save())
                {
                    $tec=TechnicianDetail::select('technician_detail_technician_id')->where('technician_detail_job_card_detail_id','=',$data['addedDetail'][$x]['job_card_detail_id'])->get()->toArray();
//                    return response()->json($tec,200);
//                    for($y=0; $y<count($data['addedDetail'][$x]['technician']); $y++)
//                    {
//
//                        if(in_array($data['addedDetail'][$x]['technician'][$y]['technician_id'],(array) $tec))
//                        {
//
//                        }
//                        else
//                        {
//                            $tecDetail=new TechnicianDetail();
//                            $tecDetail->technician_detail_job_card_detail_id=$data['addedDetail'][$x]['job_card_detail_id'];
//                            $tecDetail->technician_detail_technician_id=$data['addedDetail'][$x]['technician'][$y]['technician_id'];
//                            $tecDetail->save();
//                        }
//                    }

                    if(count($tec)<count($data['addedDetail'][$x]['technician']))
                    {
                        for($y=0; $y<count($data['addedDetail'][$x]['technician']); $y++)
                        {
                            for($z=$y; $z<count($tec); $z++ )
                            {
                                if($tec[$z]=$data['addedDetail'][$x]['technician'][$y]['technician_id'])
                                {
                                    $y=$z;
                                    break;
                                }
                                else
                                {
                                    $tecDetail=new TechnicianDetail();
                                    $tecDetail->technician_detail_job_card_detail_id=$data['addedDetail'][$x]['job_card_detail_id'];
                                    $tecDetail->technician_detail_technician_id=$data['addedDetail'][$x]['technician'][$y]['technician_id'];
                                    $tecDetail->save();
                                }
                            }
                        }
                    }
                    else
                    {
                        for($z=0; $z<count($tec); $z++ )
                        {
                            for ($y = $z; $y < count($data['addedDetail'][$x]['technician']); $y++) {

                                if ($tec[$z] = $data['addedDetail'][$x]['technician'][$y]['technician_id']) {
                                   $z=$y;
                                    break;
                                } else {
                                    $tecDetail = new TechnicianDetail();
                                    $tecDetail->technician_detail_job_card_detail_id = $data['addedDetail'][$x]['job_card_detail_id'];
                                    $tecDetail->technician_detail_technician_id = $data['addedDetail'][$x]['technician'][$y]['technician_id'];
                                    $tecDetail->save();
                                }

                            }
                        }
                    }

                }

            }
//            for($y=0; $y<count($data['materials']); $y++)
//            {
                $mat=ServiceMaterialDetail::select('service_material_detail_service_material_id')->where('service_material_detail_job_card_id','=',$id)->get();

                if(count($mat)<count($data['materials']))
                {
                    for($y=0; $y<count($data['materials']); $y++)
                    {
                        for($z=$y; $z<count($mat); $z++ )
                        {
                            if($mat[$z]=$data['materials'][$y]['service_material_id'])
                            {

                                $getMat=ServiceMaterialDetail::where('service_material_detail_service_material_id','=',$data['materials'][$y]['service_material_id'])->where('service_material_detail_job_card_id','=',$id)->first();
                                $getMat->service_material_unit_price=$data['materials'][$y]['service_material_unit_price'];
                                $getMat->service_material_detail_qty=$data['materials'][$y]['service_material_detail_qty'];
                                $getMat->save();
                                $y=$z;
                                break;
                            }
                            else
                            {
                                $material=new ServiceMaterialDetail();
                                $material->service_material_detail_service_material_id=$data['materials'][$y]['service_material_id'];
                                $material->service_material_detail_job_card_id=$id;
                                $material->service_material_unit_price=$data['materials'][$y]['service_material_unit_price'];
                                $material->service_material_detail_qty=$data['materials'][$y]['service_material_detail_qty'];
                                $material->save();
                            }
                        }
                    }
                }
                else
                {
                    for($y=0; $y<count($mat); $y++)
                    {
                        for($y=$z; $z<count($data['materials']); $y++ )
                        {
                            if($mat[$y]=$data['materials'][$z]['service_material_id'])
                            {

                                $mat[$y]->service_material_unit_price=$data['materials'][$z]['service_material_unit_price'];
                                $mat[$y]->service_material_detail_qty=$data['materials'][$z]['service_material_detail_qty'];
                                $mat->save();
                                $z=$y;
                                break;
                            }
                            else
                            {
                                $material=new ServiceMaterialDetail();
                                $material->service_material_detail_service_material_id=$data['materials'][$z]['service_material_id'];
                                $material->service_material_detail_job_card_id=$id;
                                $material->service_material_unit_price=$data['materials'][$z]['service_material_unit_price'];
                                $material->service_material_detail_qty=$data['materials'][$z]['service_material_detail_qty'];
                                $material->save();
                            }
                        }
                    }
                }

//            }

            if($success)
            {
                return response()->json(["msg"=>"Job Updated"],200);
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

    public function getCompleteJobCard()
    {
        $jobCard=JobCard::with(['getVehicle.getBrand','getVehicle.getModel','getUser'])->where('job_card_status','=',2)->get();
        return response()->json(['jobCard'=>$jobCard]);
    }
}
