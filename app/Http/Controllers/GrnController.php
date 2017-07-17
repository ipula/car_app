<?php

namespace App\Http\Controllers;

use App\Grn;
use App\GrnDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrnController extends Controller
{
    public function getGrn()
    {
        $grn=Grn::with(['getGrnDetail.getServiceMaterial','getSupplier'])->get();
        return response()->json(['grn'=>$grn],200);

    }

    public function createGrn(Request $request)
    {
        date_default_timezone_set("Asia/Colombo");

        $data=$request->all();

        $grn= new Grn();
        $grn->grn_date=date('Y-m-d');
        $grn->grn_time=date('H:i:s');
        $grn->grn_no_of_items=$data['grnAggregateData']['grn_no_of_items'];
        $grn->grn_sup_id=$data['supplier']['supplier_id'];
        $grn->grn_users_id=Auth::user()->id;
        $grn->grn_discount=$data['discount'];
        $grn->grn_total=$data['grnAggregateData']['grn_total']-($data['grnAggregateData']['grn_total']*($data['discount']/100));
        $grn->save();

        if($grn->save())
        {
            foreach ($data['addedItems'] as $item)
            {
                $newGRNDetail=new GrnDetail();
                $newGRNDetail->grn_detail_service_material_id = $item['service_material']['service_material_id'];
                $newGRNDetail->grn_detail_qty = $item['grn_detail_qty'];
                $newGRNDetail->grn_detail_qty_string = $item['grn_detail_qty'];
                $newGRNDetail->grn_detail_unit = $item['grn_detail_unit'];
                $newGRNDetail->grn_detail_pur_unit_price = $item['grn_detail_pur_unit_price'];
                $newGRNDetail->grn_detail_type =1;
                $newGRNDetail->save();
            }
            return response()->json("Grn Added Success",200);
        }
        else
        {
            return response()->json("Something Went wrong",500);
        }
    }

    public function getGrnDetail($id=null)
    {
        $grn=Grn::with(['getGrnDetail.getServiceMaterial','getSupplier'])->find($id);
        return response()->json(['grn'=>$grn],200);
    }
}
