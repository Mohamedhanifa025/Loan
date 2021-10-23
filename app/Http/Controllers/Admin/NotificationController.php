<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
  public function index()
  {
      $notifications = Notification::all();
    return view('admin.notification.index' , compact('notifications'));
  }
  public function create()
  {
      abort_unless(\Gate::allows('notification_create'), 403);

      return view('admin.notification.create');
  }

  public function store(Request $request)
  {

      $notification = Notification::create($request->all());

      return redirect()->route('admin.notification.index');
  }

  public function edit(Notification $notification)
  {
      abort_unless(\Gate::allows('notification_edit'), 403);

      return view('admin.notification.edit', compact('notification'));
  }

  public function update(Request $request, Notification $notification)
  {
      abort_unless(\Gate::allows('notification_edit'), 403);

      $notification->update($request->all());

      return redirect()->route('admin.notification.index');
  }

  public function show(Notification $notification)
  {
      abort_unless(\Gate::allows('notification_show'), 403);

      return view('admin.notification.show', compact('notification'));
  }

  public function destroy(Notification $notification)
  {
      abort_unless(\Gate::allows('notification_delete'), 403);

      $notification->delete();

      return back();
  }

  public function massDestroy(Request $request)
  {
    Notification::whereIn('id', request('ids'))->delete();

      return response(null, 204);
  }
}
