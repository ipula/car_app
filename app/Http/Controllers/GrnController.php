<?php

namespace App\Http\Controllers;

use App\Grn;
use App\GrnDetail;
use App\GrnPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrnController extends Controller
{
    public function getGrn()
    {
        $grn=Grn::with(['getGrnDetail.getServiceMaterial','getSupplier'])->orderBy('grn_id','desc')->paginate(10);
        return response()->json(['grn'=>$grn],200);

    }

    public function createGrn(Request $request)
    {
        date_default_timezone_set("Asia/Colombo");

        $data=$request->all();

        $grn= new Grn();
        $grn->grn_date=date('Y-m-d');
        $grn->grn_time=date('H:i:s');
        $grn->grn_no_of_items=$data['itemAggregateData']['no_of_items'];
//        $grn->grn_sup_id=1;
        $grn->grn_sup_id=$data['supplier']['supplier_id'];
        $grn->grn_users_id=Auth::user()->id;
        $grn->grn_discount=$data['grnData']['discount'];
        $grn->grn_total=$data['itemAggregateData']['total_amount']-($data['itemAggregateData']['total_amount']*($data['grnData']['discount']/100));
        $grn->save();

        if($grn->save())
        {
            foreach ($data['addedItems'] as $item)
            {
                $newGRNDetail=new GrnDetail();
                $newGRNDetail->grn_detail_service_material_id = $item['service_material']['service_material_id'];
                $newGRNDetail->grn_detail_grn_id =Grn::max('grn_id');
                $newGRNDetail->grn_detail_qty = $item['grn_detail_qty'];
                $newGRNDetail->grn_detail_qty_string = $item['grn_detail_qty'];
                $newGRNDetail->grn_detail_unit = $item['grn_detail_unit'];
                $newGRNDetail->grn_detail_pur_unit_price = $item['grn_detail_pur_unit_price'];
                $newGRNDetail->grn_detail_type =1;
                $newGRNDetail->save();
            }
            foreach ($data['addedCardPayments'] as $card)
            {
                $newGrnPayment=new GrnPayment();
                $newGrnPayment->grn_payment_grn_id=Grn::max('grn_id');
                $newGrnPayment->grn_payment_type=2;
                $newGrnPayment->grn_payment_amount=$card['card_total'];
//                $newGrnPayment->grn_payment_effective_date=date('Y-m-d');
                $newGrnPayment->grn_payment_bank=$card['bank'];
                $newGrnPayment->grn_payment_note=$card['transaction_id'];
                $newGrnPayment->save();
            }
            foreach ($data['addedCashPayments'] as $cash)
            {
                $newGrnPayment=new GrnPayment();
                $newGrnPayment->grn_payment_grn_id=Grn::max('grn_id');
                $newGrnPayment->grn_payment_type=2;
                $newGrnPayment->grn_payment_amount=$cash['cash_amount'];
                $newGrnPayment->save();
            }
            foreach ($data['addedChequePayments'] as $cheque)
            {
                $newGrnPayment=new GrnPayment();
                $newGrnPayment->grn_payment_grn_id=Grn::max('grn_id');
                $newGrnPayment->grn_payment_type=3;
                $newGrnPayment->grn_payment_amount=$cheque['cheque_total'];
                $newGrnPayment->grn_payment_effective_date=$cheque['date'];
                $newGrnPayment->grn_payment_bank=$cheque['bank'];
                $newGrnPayment->grn_payment_note=$cheque['cheque_no'];
                $newGrnPayment->save();
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
