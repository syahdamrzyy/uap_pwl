<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function manajemenAdmin()
    {
        $admins = User::where('is_admin', 1)->get();
        return view('admin.manajemen_admin', compact('admins'));
    }
}
