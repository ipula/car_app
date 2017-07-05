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
        $invoice->invoice_total=$data['invoiceAggregateData']['invoice_total'];
        $invoice->invoice_cash_pay=$data['cash_pay'];
        $invoice->invoice_discount_rate=$data['invoice_discount_rate'];
        $invoice->invoice_card_pay=$data['invoice_card_pay'];
        $invoice->invoice_cheque_pay=$data['invoice_cheque_pay'];
        $invoice->invoice_job_card_id=$data['job_card']['invoice_job_card_id'];
        $invoice->invoice_users_id=Auth::user()->id;
        $invoice->save();

        if($invoice->save())
        {
            for($x=0; $x<count($data['cashPayments']); $x++)
            {
                $payment=new InvoicePayment();
                $payment->payment_invoice_no=Invoice::max('invoice_no');
                $payment->payment_type=1;
                $payment->payment_amount=$data['cashPayments'][$x]['payment_amount'];
                $payment->payment_detail='CASH';
                $payment->payment_effective_date=date('Y-m-d');
                $payment->payment_customer_id=$data['vehicle']['vehicle_id'];
                $payment->save();
            }
            for($x=0; $x<count($data['cardPayments']); $x++)
            {
                $payment=new InvoicePayment();
                $payment->payment_invoice_no=Invoice::max('invoice_no');
                $payment->payment_type=1;
                $payment->payment_amount=$data['cardPayments'][$x]['payment_amount'];
                $payment->payment_detail='CARD';
                $payment->payment_effective_date=$data['cardPayments'][$x]['payment_effective_date'];
                $payment->payment_bank=$data['cardPayments'][$x]['payment_bank'];
                $payment->payment_note=$data['cardPayments'][$x]['payment_note'];
                $payment->payment_receipt_no=$data['cardPayments'][$x]['payment_receipt_no'];
                $payment->payment_customer_id=$data['vehicle']['vehicle_id'];
                $payment->save();
            }
            for($x=0; $x<count($data['chequePayments']); $x++)
            {
                $payment=new InvoicePayment();
                $payment->payment_invoice_no=Invoice::max('invoice_no');
                $payment->payment_type=1;
                $payment->payment_amount=$data['chequePayments'][$x]['payment_amount'];
                $payment->payment_detail='CHEQUE';
                $payment->payment_effective_date=date('Y-m-d');
                $payment->payment_bank=$data['chequePayments'][$x]['payment_bank'];
                $payment->payment_note=$data['chequePayments'][$x]['payment_note'];
                $payment->payment_receipt_no=$data['chequePayments'][$x]['payment_receipt_no'];
                $payment->payment_customer_id=$data['vehicle']['vehicle_id'];
                $payment->save();
            }

            return response()->json(["msg"=>" Invoice Created"],200);
        }
        else
        {
            return response()->json(["msg"=>"Invoice Created Failed"],500);
        }
    }
}
