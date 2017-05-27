<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\Role;
use App\Models\Blog;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

    public function index()
    {
        $title = 'Dashboard';
        $users = User::count();
        $roles = Role::count();

        return view('admin.dashboard.index',  compact('title', 'users', 'roles'));
    }
}
