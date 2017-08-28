<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function createAgent(Request $request)
    {
        $data=$request->all();

        $agent=new Agent();
        $agent->agent_name=$data['agent_name'];
        $agent->agent_tel1=$data['agent_tel1'];
        $agent->agent_tel2=$data['agent_tel2'];
        $agent->agent_address=$data['agent_address'];
        $agent->agent_code=$data['agent_code'];
        $agent->agent_discount=$data['agent_discount'];
        $agent->save();

        if($agent->save())
        {
            return response()->json(["msg"=>"New Agent Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"New Agent Created Failed"],500);
        }
    }

    public function editAgent($id=null,Request $request)
    {
        $data=$request->all();

        $agent=Agent::find($id);
        $agent->agent_name=$data['agent_name'];
        $agent->agent_tel1=$data['agent_tel1'];
        $agent->agent_tel2=$data['agent_tel2'];
        $agent->agent_address=$data['agent_address'];
        $agent->agent_code=$data['agent_code'];
        $agent->agent_discount=$data['agent_discount'];
        $agent->save();

        if($agent->save())
        {
            return response()->json(["msg"=>"Agent Update Success"],200);
        }
        else
        {
            return response()->json(["msg"=>"Agent Update Failed"],500);
        }
    }

    public function loadAgent($id=null)
    {
        $agent=Agent::find($id);
        return response()->json(["agent"=>$agent],200);
    }
    public function getAgent(Request $request)
    {
        if(isset($request['page']) && $request['page']!=0)
        {
            $agent=Agent::orderBy('agent_id','desc')->paginate(10);
        }
        else
        {
            $agent=Agent::all();
        }
        return response()->json(["agent"=>$agent],200);
    }

    public function searchAgent($name=null)
    {
        $agent=Agent::where('agent_name','LIKE', '%' . $name . '%')->get();
        return response()->json(["agent"=>$agent],200);
    }

    public function searchAgentPaginate($name=null)
    {
        $agent=Agent::where('agent_name','LIKE', '%' . $name . '%')->orderBy('agent_id','desc')->paginate(10);
        return response()->json(["agent"=>$agent],200);
    }

}
