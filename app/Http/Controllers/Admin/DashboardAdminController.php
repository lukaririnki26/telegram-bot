<?php

namespace App\Http\Controllers\Admin;

/**
 * Admin Dashboard Controller Class
 */
class DashboardAdminController extends AdminController
{
    public function index()
    {
        return view('dashboard');
    }
}
