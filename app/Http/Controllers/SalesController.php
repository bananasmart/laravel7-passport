<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class SalesController extends BaseController
{

    public function getSales($invoicenumber = null){
        if($invoicenumber){
            $sales = \App\Sale::where('invoicenumber', $invoicenumber)->with('details')->get();
            return $this->sendResponse('Success', $sales); 
        }else{
            $sales = \App\Sale::with('details')->get();
            return $this->sendResponse('Success', $sales);  
        }
    }

    public function getSalesCustomer(Request $request, $invoicenumber){
     
        $sale  = new \App\Sale();
        $sale =  $sale->where('invoicenumber', $invoicenumber)->with('customer')->first();
        return $sale->customer;
        
        
            

        }
    }