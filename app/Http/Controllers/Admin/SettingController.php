<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function index()
  {
      $settings = Setting::all();
    return view('admin.setting.index' , compact('settings'));
  }
  public function create()
  {
      abort_unless(\Gate::allows('setting_create'), 403);

      return view('admin.setting.create');
  }

  public function store(Request $request)
  {

      $setting = Setting::create($request->all());

      return redirect()->route('admin.setting.index');
  }

  public function edit(Customer $customer)
  {
      abort_unless(\Gate::allows('setting_edit'), 403);

      return view('admin.setting.edit', compact('setting'));
  }

  public function update(Request $request, Setting $setting)
  {
      abort_unless(\Gate::allows('customer_edit'), 403);

      $setting->update($request->all());

      return redirect()->route('admin.setting.index');
  }

  public function show(Setting $setting)
  {
      abort_unless(\Gate::allows('setting_show'), 403);

      return view('admin.setting.show', compact('setting'));
  }

  public function destroy(Setting $setting)
  {
      abort_unless(\Gate::allows('setting_delete'), 403);

      $setting->delete();

      return back();
  }

  public function massDestroy(Request $request)
  {
    Setting::whereIn('id', request('ids'))->delete();

      return response(null, 204);
  }
}
