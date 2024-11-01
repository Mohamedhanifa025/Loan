<?php

namespace App\Http\Controllers\Admin;

use App\Contacts;
use App\Customer;
use App\Notification;
use App\User;

class HomeController
{
    public function index()
    {
        if(in_array(1, auth()->user()->roles->pluck('id')->toArray())) {
            $total_contacts = Contacts::count();
            $recent_notifications = Notification::orderBy('id', 'desc')->limit(10)->get();
        } else {
            $total_contacts = Contacts::where('user_id', auth()->user()->id)->count();
            $recent_notifications = Notification::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->limit(10)->get();
        }
        $total_employees = User::count();
        $total_customers = Customer::count();
        $recent_customers = Customer::orderBy('id', 'desc')->limit(10)->get();
        return view('home', compact('total_contacts', 'total_employees', 'total_customers', 'recent_customers', 'recent_notifications'));
    }
}
