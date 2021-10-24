<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        $customers = new Customer;

        if($request->has('term') && $request->term != '') {
            $customers = $customers->where('name', 'LIKE', "%$request->term%")
            ->where('email', 'LIKE', "%$request->term%")
            ->where('mobile_number', 'LIKE', "%$request->term%");
        }

        if($request->has('status') && $request->status != '') {
            $customers = $customers->where('status', $request->status);
        }

        $customers = $customers->get();

      return view('admin.customers.index' , compact('customers'));
    }
    public function create()
    {
        abort_unless(\Gate::allows('customer_create'), 403);

        return view('admin.customers.create');
    }

    public function store(Request $request)
    {

        $customer = Customer::create($request->all());

        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_unless(\Gate::allows('customer_edit'), 403);

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        abort_unless(\Gate::allows('customer_edit'), 403);

        $customer->update($request->all());

        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_unless(\Gate::allows('customer_show'), 403);

        return view('admin.customers.show', compact('customer'));
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
