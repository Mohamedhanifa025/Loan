<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contacts;

class ContactController extends Controller
{
    
    public function index()
    {
        $contacts = Contacts::all();
      return view('admin.contact.index' , compact('contacts'));
    }
    public function create()
    {
        abort_unless(\Gate::allows('contacts_create'), 403);

        return view('admin.contact.create');
    }

    public function store(Request $request)
    {

        $contact = Contacts::create($request->all());

        return redirect()->route('admin.contact.index');
    }

    public function edit(Contacts $contact)
    {
        abort_unless(\Gate::allows('contacts_edit'), 403);

        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, Contacts $contact)
    {
        abort_unless(\Gate::allows('contacts_edit'), 403);

        $contact->update($request->all());

        return redirect()->route('admin.contact.index');
    }

    public function show(Contacts $contact)
    {
        abort_unless(\Gate::allows('contacts_show'), 403);

        return view('admin.contact.show', compact('contact'));
    }

    public function destroy(Contacts $contact)
    {
        abort_unless(\Gate::allows('contacts_delete'), 403);

        $contact->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Contacts::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
