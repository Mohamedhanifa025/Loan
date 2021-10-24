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
        $total_contacts = Contacts::count();
        $total_employees = User::count();
        $total_customers = Customer::count();
        $recent_customers = Customer::orderBy('id', 'desc')->limit(10)->get();
        $recent_notifications = Notification::orderBy('id', 'desc')->limit(10)->get();
        return view('home', compact('total_contacts', 'total_employees', 'total_customers', 'recent_customers', 'recent_notifications'));
    }
}
