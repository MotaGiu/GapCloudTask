<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $usersByType = User::select('type', \DB::raw('count(*) as count'))
                           ->groupBy('type')
                           ->get();
        // Update the view path to point to the correct admin dashboard view
        return view('admin.auth.dashboard', compact('userCount', 'usersByType'));
    }
    
}


