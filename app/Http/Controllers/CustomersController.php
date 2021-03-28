<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class CustomersController extends BaseController
{
    
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

    public function updateCustomer(Request $request, $customerid, $fullname= null, $phone = null, $mobile = null, $email = null, $main_address = null){
    
        \App\Customer::where('customerid', $customerid)
        ->update(["fullname" => $fullname, 
        "phone" => $phone,
        "mobile" => $mobile,
        "email" => $email,
        "main_address" => $main_address
        ]);

        return $this->sendResponse('Success', 'Customer has been updated successfully');
    }

    public function deleteCustomer(Request $request, $customerid){
        \App\Customer::where('customerid', $customerid)
        ->delete();

        return $this->sendResponse('Success', 'Customer has been deleted successfully');
    }
   
   
}