<?php

namespace App\Http\Controllers\Admin;

use App\ApplyLoan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoansController extends Controller
{
  public function index()
  {
      $loans = ApplyLoan::all();
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

      return redirect()->route('admin.loans.index');
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
