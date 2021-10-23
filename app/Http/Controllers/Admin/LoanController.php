<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apply_loan;

class LoanController extends Controller
{
  public function index()
  {
      $loans = Apply_loan::all();
    return view('admin.loan.index' , compact('loans'));
  }
  public function create()
  {
      abort_unless(\Gate::allows('loan_create'), 403);

      return view('admin.loan.create');
  }

  public function store(Request $request)
  {

      $loan = Apply_loan::create($request->all());

      return redirect()->route('admin.loan.index');
  }

  public function edit(Apply_loan $loan)
  {
      abort_unless(\Gate::allows('loan_edit'), 403);

      return view('admin.loan.edit', compact('loan'));
  }

  public function update(Request $request, Apply_loan $loan)
  {
      abort_unless(\Gate::allows('loan_edit'), 403);

      $loan->update($request->all());

      return redirect()->route('admin.loan.index');
  }

  public function show(Apply_loan $loan)
  {
      abort_unless(\Gate::allows('loan_show'), 403);

      return view('admin.loan.show', compact('loan'));
  }

  public function destroy(Apply_loan $loan)
  {
      abort_unless(\Gate::allows('loan_delete'), 403);

      $loan->delete();

      return back();
  }

  public function massDestroy(Request $request)
  {
    Apply_loan::whereIn('id', request('ids'))->delete();

      return response(null, 204);
  }
}
