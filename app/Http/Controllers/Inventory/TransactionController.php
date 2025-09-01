<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function payments()
    {
        return view('inventory.transaction.payments');
    }

    public function outstandings()
    {
        return view('inventory.transaction.outstandings');
    }

    public function get_outstandings(Request $request)
    {
        if(!isset($request['order'])){
            if($request['order']!='desc')
            $request['order']='desc';
        
        }

        if(!isset($request['search'])){
            if($request['search']!='%%')
            $request['search']='%%';
        
        }

        if(!isset($request['filter'])){

            $request['filter'] = [];
        
        }

        if(!isset($request['sort'])){
            if($request['sort']!='id')
            $request['sort']='id';
        
        }

        $rows = \App\Models\Inventory\Transaction::where('type',2)->with('customer')->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\Inventory\Transaction::where('type',2)->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function get_payments(Request $request)
    {
        if(!isset($request['order'])){
            if($request['order']!='desc')
            $request['order']='desc';
        
        }

        if(!isset($request['search'])){
            if($request['search']!='%%')
            $request['search']='%%';
        
        }

        if(!isset($request['filter'])){

            $request['filter'] = [];
        
        }

        if(!isset($request['sort'])){
            if($request['sort']!='id')
            $request['sort']='id';
        
        }

        $rows = \App\Models\Inventory\Transaction::where('type',1)->with('supplier')->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\Inventory\Transaction::where('type',1)->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    
}
