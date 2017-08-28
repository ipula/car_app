<?php

namespace App\Http\Controllers;

use App\JobCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function getJobCardCount()
    {
        $data=array();
        $total="select DATE_FORMAT(created_at, '%a') as date ,count(job_card_id) as total from job_card where date_format(created_at, '%Y-%m-%d') between CURDATE() - INTERVAL 6 DAY and CURDATE() group by DATE_FORMAT(created_at, '%a')";
        $result=DB::select(DB::raw($total));

            for($y=0; $y<count($result); $y++)
            {
                $data[0]['name']="JOBS";
                $data[0]['series'][$y]['value']=(double)$result[$y]->total;
                $data[0]['series'][$y]['name']=$result[$y]->date;
            }

        return response()->json(["job"=>$data],200);
    }
}
