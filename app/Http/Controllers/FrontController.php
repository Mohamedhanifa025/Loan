<?php

namespace App\Http\Controllers;

use App\ApplyLoan;
use App\Customer;
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
            'mobile_number' => 'required',
            'company_name' => 'required_if:type,pl',
            'salary' => 'required_if:type,pl|',
            'company_type' => 'required_if:type,bl,hl,cl,lap',
            'business_type' => 'required_if:type,bl,hl,cl,lap',
            'income_type' => 'required_if:type,bl,hl,cl,lap',
            'employee_type' => 'required_if:type,dl',
            'message' => 'required',
            'location' => 'required',
        ]);
        /*$request->merge(['password' => 'Customer@2021']);
        $customer = Customer::firstOrCreate([
            'email' => $request->email
        ], $request->only('email', 'name', 'mobile_number', 'password')
        );
        $data['customer_id'] = $customer->id;*/
        $apply_loan = ApplyLoan::create($data);

        return redirect()->route('apply.loan.view')->with('success', 'Loan application submitted successfully!');
    }
}
