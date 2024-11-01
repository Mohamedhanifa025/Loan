<?php

namespace App\Http\Controllers\Admin;

use App\ApplyLoan;
use App\Contacts;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Referral;
use Illuminate\Http\Request;

class LoansController extends Controller
{
  public function index(Request $request)
  {
      $loans = new ApplyLoan;

      if ($request->has('term') && $request->term != '') {
          $loans = $loans->where(function ($q) use($request) {
              $l = $q->where('name', 'LIKE', "%$request->term%")
                  ->orWhere('email', 'LIKE', "%$request->term%")
                  ->orWhere('mobile_number', 'LIKE', "%$request->term%");
              $types = array_flip(config('constant.loan_types'));
              if(array_key_exists($request->term, $types)) {
                  $l = $l->
                  orWhere('type', $types);
              }
          });
      }
      if ($request->has('status') && $request->status != '') {
          $loans = $loans->where('status', $request->status);
      }
      $loans = $loans->get();

    return view('admin.loans.index' , compact('loans'));
  }
  public function create()
  {
      abort_unless(\Gate::allows('loan_create'), 403);

      return view('admin.loans.create');
  }

  public function store(Request $request)
  {
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
      $loan = ApplyLoan::create($request->all());

      return redirect()->route('admin.loans.index');
  }

  public function edit(ApplyLoan $loan)
  {
      abort_unless(\Gate::allows('loan_edit'), 403);

      return view('admin.loans.edit', compact('loan'));
  }

  public function update(Request $request, ApplyLoan $loan)
  {
      abort_unless(\Gate::allows('loan_edit'), 403);
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
      $loan->update($request->all());

      if(is_null($loan->customer_id)) {
          $getCustomer = Customer::where('mobile_number', $loan->mobile_number)->first();
          if(is_null($getCustomer)) {
              return redirect()->route('admin.loans.index')->with('error', 'Create a customer with loan\'s mobile number first!');
          } else {
              $loan->update(['customer_id' => $getCustomer->id]);
          }
      }
      $getContact = Contacts::where('mobile_number', $request->mobile_number)->first();
      $msg = 'Loan application updated successfully!';
      if(!is_null($getContact) && !is_null($getContact->customer_id)) {
          $ref['apply_loan_id'] = $loan->id;
          $ref['customer_id'] = $loan->customer_id;
          $ref['referred_id'] = $getContact->customer_id;
          $ref['points'] = env('REFERRAL_POINTS', 10);
          $ref['status'] = $loan->status;
          Referral::updateOrCreate([
              'customer_id' => $ref['customer_id'],
              'referred_id' => $ref['referred_id'],
              'apply_loan_id' => $ref['apply_loan_id']
          ], $ref);
      } else {
          $msg .= " And, No Referral customer found for loan mobile number $loan->mobile_number!";
      }
      return redirect()->route('admin.loans.index')->with('success', $msg);
  }

  public function show(ApplyLoan $loan)
  {
      abort_unless(\Gate::allows('loan_show'), 403);

      return view('admin.loans.show', compact('loan'));
  }

  public function destroy(ApplyLoan $loan)
  {
      abort_unless(\Gate::allows('loan_delete'), 403);

      $loan->delete();

      return back();
  }

  public function massDestroy(Request $request)
  {
      ApplyLoan::whereIn('id', request('ids'))->delete();

      return response(null, 204);
  }
}
