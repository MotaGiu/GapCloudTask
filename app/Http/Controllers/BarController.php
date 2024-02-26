<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarController extends Controller
{
    public function userChart(){
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                     ->whereYear('created_at', date('Y'))
                     ->groupBy('month')
                     ->orderby('month')
                     ->get();


        $labels = [];
        $data = [];
        $colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', '#000000', '#FFFFFF'];

        for($i=1; $i < 12; $i++){
            $month = date('F', mktime(0,0,0,$i,1));
            $count = 0;

            foreach($users as $user){
                if($user->month == $i){
                    $count = $user->count;
                    break;
                }
            }

            array_push($labels,$month);
            array_push($data,$count);
        }

        $datasets = [
            [
                'label'=> 'Users',
                'data'=> $data,
                'backgroundColor'=> $colors
        ]
            
            ];
            return view('charts', compact('datasets','labels'));



    }
}
