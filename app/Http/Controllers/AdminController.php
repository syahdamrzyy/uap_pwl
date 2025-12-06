<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function manajemenAdmin()
    {
        // asumsikan kolom role di users (role = 'admin')
        $admins = User::where('role', 'admin')->get();
        return view('admin.manajemen_admin', compact('admins'));
    }
}
