<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request['order'])){
            if($request['order']!='desc')
            $request['order']='desc';
        
        }

        if(!isset($request['search'])){
            if($request['search']!='%%')
            $request['search']='%%';
        
        }else{
            $request['search']='%'.$request['search'].'%';
        }

        if(!isset($request['filter'])){

            $request['filter'] = [];
        
        }

        if(!isset($request['sort'])){
            if($request['sort']!='id')
            $request['sort']='id';
        
        }

        $rows = \App\Models\Inventory\SupplierDetail::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('supplier_name','like',$request['search'])
                      ->orwhere('supplier_email','like',$request['search'])
                      ->orwhere('supplier_address','like',$request['search'])
                      ->orwhere('supplier_contact1','like',$request['search'])
                      ->orwhere('supplier_contact2','like',$request['search'])
                      ->orwhere('due','like',$request['search']);
                  })->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\Inventory\SupplierDetail::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('supplier_name','like',$request['search'])
                      ->orwhere('supplier_email','like',$request['search'])
                      ->orwhere('supplier_address','like',$request['search'])
                      ->orwhere('supplier_contact1','like',$request['search'])
                      ->orwhere('supplier_contact2','like',$request['search'])
                      ->orwhere('due','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('inventory.supplier.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            \App\Models\Inventory\SupplierDetail::create($request->all());

            $messageType = 1;
            $message = "Supplier created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Supplier creation failed !";            
        }

        return redirect(url("/inventory/supplier/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = \App\Models\Inventory\SupplierDetail::find($id);

        return view('inventory.supplier.edit')->with('supplier',$supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $supplier = \App\Models\Inventory\SupplierDetail::find($id);

            $supplier->update($request->all());

            $messageType = 1;
            $message = "Supplier ".$supplier->supplier_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Supplier updation failed !";
        }

        return redirect(url("/inventory/supplier/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $supplier = \App\Models\Inventory\SupplierDetail::find($id);

            $supplier->delete();    

            $messageType = 1;
            $message = "Supplier ".$supplier->supplier_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Supplier deletion failed !";
        }
        
        return redirect(url("/inventory/supplier/view"))->with('messageType',$messageType)->with('message',$message);
    }
}
