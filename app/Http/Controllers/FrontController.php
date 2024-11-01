<?php

namespace App\Http\Controllers;

use App\ApplyLoan;
use App\Contacts;
use App\Customer;
use App\Referral;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applyLoan()
    {
        return view('apply_loan');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
           'type' => 'required',
           'email' => 'required',
           'name' => 'required',
            'mobile_number' => 'required|digits:10',
            'company_name' => 'required_if:type,pl',
            'salary' => 'required_if:type,pl',
            'company_type' => 'required_if:type,bl,hl,cl,lap',
            'business_type' => 'required_if:type,bl,hl,cl,lap',
            'income_type' => 'required_if:type,bl,hl,cl,lap',
            'employee_type' => 'required_if:type,dl',
            'message' => 'required',
            'location' => 'required|max:50',
        ]);
        //dd(json_encode($data));
        /*$request->merge(['password' => 'Customer@2021']);
        $customer = Customer::firstOrCreate([
            'email' => $request->email
        ], $request->only('email', 'name', 'mobile_number', 'password')
        );
        $data['customer_id'] = $customer->id;*/
        $loan = ApplyLoan::create($data);
        if(is_null($loan->customer_id)) {
            $getCustomer = Customer::where('mobile_number', $loan->mobile_number)->first();
            if(!is_null($getCustomer)) {
                $loan->update(['customer_id' => $getCustomer->id]);
            }
        }
        $getContact = Contacts::where('mobile_number', $request->mobile_number)->first();
        if(!is_null($getContact) && !is_null($getContact->customer_id)) {
            $ref['apply_loan_id'] = $loan->id;
            $ref['customer_id'] = $loan->customer_id;
            $ref['referred_id'] = $getContact->customer_id;
            $ref['points'] = env('REFERRAL_POINTS', 10);
            $ref['status'] = 0;
            Referral::updateOrCreate([
                'customer_id' => $ref['customer_id'],
                'referred_id' => $ref['referred_id'],
                'apply_loan_id' => $ref['apply_loan_id']
            ], $ref);
        }

        return redirect()->route('apply.loan.view')->with('success', 'Loan application submitted successfully!');
    }
}
