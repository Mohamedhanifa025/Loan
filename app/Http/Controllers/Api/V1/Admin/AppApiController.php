<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ApplyLoan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Contacts;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppApiController extends Controller
{
    public function index()
    {
        $products = Auth::guard()->user()->contacts;

        return $products;
    }

    public function applyLoan(Request $request)
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
            'location' => 'required',
        ]);
        $data['customer_id'] = Auth::guard()->user()->id;
        $loan = ApplyLoan::create($data);
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

        return response()->json(['status' => 1, 'message' => 'Loan application submitted successfully!'], 200);

    }

    public function importContacts(Request $request) {
        $data = $request->all();
        if(isset($data['contacts']) && count($data['contacts']) > 0) {
            $i = 0;
            $customer_id = Auth::guard()->user()->id;
            foreach ($data['contacts'] as $contact) {
                $check = Contacts::where('mobile_number', $contact['mobile_number'])->where('customer_id', '!=', $customer_id)->first();
                if(is_null($check)) {
                    Contacts::updateOrCreate([
                        'customer_id' => $customer_id,
                        'mobile_number' => $contact['mobile_number']
                    ],
                    [
                       'customer_id' => $customer_id,
                       'mobile_number' => $contact['mobile_number'],
                       'name' => $contact['name']
                    ]);
                    $i++;
                }
            }
            $status = 1;
            $message = "$i Contact(s) created/updated successfully!";
        } else {
            $status = 0;
            $message = "Please upload at least one contact!";
        }
        return response()->json(['status' => $status, 'message' => $message], 200);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return $product->update($request->all());
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }

    public function rewards()
    {
        $user = Auth::guard()->user();
        $rewards = Auth::guard()->user()->referrals;
        return response()->json(['status' => 1, 'message' => "Customer Referrals" , 'data' => $user], 200);
    }
}
