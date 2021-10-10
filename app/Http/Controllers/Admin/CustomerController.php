<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customers = Customer::all();
      return view('customer.index' , compact('customers'));
    }
    public function create()
    {
        abort_unless(\Gate::allows('customer_create'), 403);

        return view('customer.create');
    }

    public function store(Request $request)
    {

        $customer = Customer::create($request->all());

        return redirect()->route('customer.index');
    }

    public function edit(Customer $customer)
    {
        abort_unless(\Gate::allows('customer_edit'), 403);

        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        abort_unless(\Gate::allows('customer_edit'), 403);

        $customer->update($request->all());

        return redirect()->route('customer.index');
    }

    public function show(Customer $customer)
    {
        abort_unless(\Gate::allows('customer_show'), 403);

        return view('customer.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        abort_unless(\Gate::allows('customer_delete'), 403);

        $customer->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
      Customer::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
