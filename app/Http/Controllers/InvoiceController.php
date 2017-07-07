<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoicePayment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getAllInvoice()
    {
        $invoice=Invoice::with(['getJobCard.getVehicle','getJobCard.getUser','getUsers'])->get();
        return response()->json(['invoice'=>$invoice]);
    }

    public function createInvoice(Request $request)
    {
        date_default_timezone_set("Asia/Colombo");

        $data=$request->all();
        $invoice=new Invoice();
        $invoice->invoice_date=date('Y-m-d');
        $invoice->invoice_time=date('H:i:s');
        $invoice->invoice_total=$data['invoice_total'];
        $invoice->invoice_cash_pay=$data['cashAggregateData']['cash_total'];
        $invoice->invoice_discount_rate=$data['discountPayments']['discount'];
        $invoice->invoice_card_pay=$data['cardAggregateData']['card_total'];
        $invoice->invoice_cheque_pay=$data['chequeAggregateData']['cheque_total'];
        $invoice->invoice_job_card_id=$data['job_card_id']['job_card_id'];
        $invoice->invoice_users_id=$data['job_card_id']['get_user']['id'];
        $invoice->save();

        if($invoice->save())
        {
            for($x=0; $x<count($data['addedCashPayments']); $x++)
            {
                $payment=new InvoicePayment();
                $payment->payment_invoice_no=Invoice::max('invoice_no');
                $payment->payment_type=1;
                $payment->payment_amount=$data['addedCashPayments'][$x]['cash_amount'];
                $payment->payment_detail='CASH';
                $payment->payment_effective_date=date('Y-m-d');
                $payment->payment_customer_id=$data['vehicle_id'];
                $payment->save();
            }
            for($x=0; $x<count($data['addedCardPayments']); $x++)
            {
                $payment=new InvoicePayment();
                $payment->payment_invoice_no=Invoice::max('invoice_no');
                $payment->payment_type=2;
                $payment->payment_amount=$data['addedCardPayments'][$x]['card_total'];
                $payment->payment_detail='CARD';
                $payment->payment_effective_date=date('Y-m-d');
                $payment->payment_bank=$data['addedCardPayments'][$x]['bank'];
//                $payment->payment_note=$data['cardPayments'][$x]['payment_note'];
                $payment->payment_receipt_no=$data['addedCardPayments'][$x]['transaction_id'];
                $payment->payment_customer_id=$data['vehicle_id'];
                $payment->save();
            }
            for($x=0; $x<count($data['addedChequePayments']); $x++)
            {
                $payment=new InvoicePayment();
                $payment->payment_invoice_no=Invoice::max('invoice_no');
                $payment->payment_type=3;
                $payment->payment_amount=$data['addedChequePayments'][$x]['cheque_total'];
                $payment->payment_detail='CHEQUE';
                $payment->payment_effective_date=$data['addedChequePayments'][$x]['date'];
                $payment->payment_bank=$data['addedChequePayments'][$x]['bank'];
//                $payment->payment_note=$data['chequePayments'][$x]['payment_note'];
                $payment->payment_receipt_no=$data['addedChequePayments'][$x]['cheque_no'];
                $payment->payment_customer_id=$data['vehicle_id'];
                $payment->save();
            }

            return response()->json(["msg"=>" Invoice Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"Invoice Created Failed"],500);
        }
    }

    public function loadInvoiceById($id=null)
    {
        $invoice=Invoice::with(['getJobCard.getVehicle','getJobCard.getUser','getJobCard.getJobCardDetails.getTechnician','getJobCard.getJobCardDetails.getService','getJobCard.getJobCardDetails.getTechnician','getJobCard.getJobCardDetails.getServiceType','getJobCard.getJobCardMaterial.getMaterial','getUsers'])->find($id);
        return response()->json(['invoice'=>$invoice]);
    }
}
