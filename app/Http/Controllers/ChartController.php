<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Use the DB facade

class ChartController extends Controller
{
    public function pieChart(){
        $result = DB::select(DB::raw("SELECT type, COUNT(*) as count FROM users WHERE type IN ('user', 'admin') GROUP BY type;"));
        $data = "";
        foreach($result as $val){
            $data .= "['" . $val->type . "', " . $val->count . "],";
        }
        $data = rtrim($data, ','); // Remove the trailing comma
        $chartData = $data;
        return view('pie', compact('chartData'));
    }

    // New method for the bar chart
    public function barChart(){
        $usersByDate = DB::table('users')
                         ->select(DB::raw('DATE(created_at) as registration_date'), DB::raw('COUNT(*) as count'))
                         ->groupBy('registration_date')
                         ->orderBy('registration_date', 'ASC')
                         ->get();

        $dates = [];
        $counts = [];
        foreach ($usersByDate as $user) {
            $dates[] = $user->registration_date;
            $counts[] = $user->count;
        }

        return view('bar', compact('dates', 'counts'));
    }
}
