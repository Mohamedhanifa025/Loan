<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Referral;

class ReferralsController extends Controller
{
  public function index()
  {
      $referrals = Referral::all();
    return view('admin.referral.index' , compact('referrals'));
  }
  public function create()
  {
      abort_unless(\Gate::allows('referral_create'), 403);

      return view('admin.referral.create');
  }

  public function store(Request $request)
  {

      $referral = Referral::create($request->all());

      return redirect()->route('admin.referral.index');
  }

  public function edit(Referral $referral)
  {
      abort_unless(\Gate::allows('referral_edit'), 403);

      return view('admin.referral.edit', compact('referral'));
  }

  public function update(Request $request, Referral $referral)
  {
      abort_unless(\Gate::allows('referral_edit'), 403);

      $referral->update($request->all());

      return redirect()->route('admin.referral.index');
  }

  public function show(Referral $referral)
  {
      abort_unless(\Gate::allows('referral_show'), 403);

      return view('admin.referral.show', compact('referral'));
  }

  public function destroy(Referral $referral)
  {
      abort_unless(\Gate::allows('referral_delete'), 403);

      $referral->delete();

      return back();
  }

  public function massDestroy(Request $request)
  {
    Referral::whereIn('id', request('ids'))->delete();

      return response(null, 204);
  }
}
