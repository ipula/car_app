<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function createSupplier(Request $request)
    {
        $data=$request->all();

        $supplier= new Supplier();
        $supplier->supplier_name=$data['supplier_name'];
        $supplier->supplier_tel_no=$data['supplier_tel_no'];
        $supplier->supplier_code=$data['supplier_code'];
        $supplier->save();


        if($supplier->save())
        {
            return response()->json(["msg"=>" New Supplier Created!"],200);
        }
        else
        {
            return response()->json(["msg"=>"Supplier Created Failed"],500);
        }
    }

    public function loadSupplier($id=null)
    {
        $supplier=Supplier::find($id);
        return response()->json(["supplier"=>$supplier],200);
    }

    public function getSupplier(Request $request)
    {
        if(isset($request['page']) && $request['page']!=0)
        {
            $supplier=Supplier::paginate(1);
        }
        else
        {
            $supplier=Supplier::all();
        }

//        return response()->json(["supplier"=>$request['page']],200);
        return response()->json(["supplier"=>$supplier],200);
    }

    public function editSupplier($id=null,Request $request)
    {
        $supplier=Supplier::find($id);
        $data=$request->all();

        $supplier->supplier_name=$data['supplier_name'];
        $supplier->supplier_tel_no=$data['supplier_tel_no'];
        $supplier->supplier_code=$data['supplier_code'];
        $supplier->save();

        if($supplier->save())
        {
            return response()->json(["msg"=>"Supplier Updated!"],200);
        }
        else
        {
            return response()->json(["msg"=>"Supplier Update Failed"],500);
        }
    }

    public function searchSupplier($name=null)
    {
        $supplier=Supplier::where('supplier_name','LIKE', '%' . $name . '%')->get();
        return response()->json(["supplier"=>$supplier],200);
    }
}
