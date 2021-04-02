<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class CustomersController extends BaseController
{

    public function getCustomers($customerid = null){
    
        if($customerid){
            $customers = \App\Customer::where('customerid', $customerid)->get();
            return $this->sendResponse('Success', $customers); 
        }else{
            $customers = \App\Customer::all();
            return $this->sendResponse('Success', $customers); 
        } 
        
    }
    
    public function createCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();

        $customerid = \App\Customer::max('customerid');
        $customer = new \App\Customer();
        $customer->customerid = $customerid + 1;
        $customer->fullname = $input['fullname'];
        $customer->email = $input['email'];
        $customer->mobile = $input['mobile'];
        $customer->phone = $input['phone'];
        $customer->main_address = $input['main_address'];
        $customer->save();
        
        return $this->sendResponse('Success', 'Customer has been created successfully.');
    }

    public function updateCustomer(Request $request){

        $validator = Validator::make($request->all(), [
            'customerid' => 'required',
            'fullname' => 'required',
            'mobile' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        \App\Customer::where('customerid', $input['customerid']) 
        ->update(["fullname" => isset($input['fullname']) ? $input['fullname'] : null, 
        "phone" => isset($input['phone']) ? $input['phone'] : null,
        "mobile" => isset($input['mobile']) ? $input['mobile'] : null,
        "email" => isset($input['email']) ? $input['email'] : null,
        "main_address" => isset($input['main_address']) ? $input['main_address'] : null
        ]);

        return $this->sendResponse('Success', 'Customer has been updated successfully');
    }

    public function deleteCustomer(Request $request, $customerid){
        \App\Customer::where('customerid', $customerid)
        ->delete();

        return $this->sendResponse('Success', 'Customer has been deleted successfully');
    }
   
   
}