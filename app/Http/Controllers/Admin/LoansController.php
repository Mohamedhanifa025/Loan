<?php

namespace App\Http\Controllers\Admin;

use App\ApplyLoan;
use App\Http\Controllers\Controller;
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

      $loan->update($request->all());

      return redirect()->route('admin.loans.index')->with('success', 'Loan application updated successfully!');
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
