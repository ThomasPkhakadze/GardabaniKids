<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kid;


class CheckIfRegisteredController extends Controller
{
    
    public function checkIfRegistered(Request $request){
        $kid = Kid::where('id_number', $request->id_number)->with('branch')->first();
        if($kid != null){
            echo json_encode(['status' => 'Found', 'kid' => ['name' => $kid->name, 'lastname' => $kid->lastname, 'branch' => $kid->branch->name]]);
        }else{
            return json_encode(['status' => 'Not Found']);
        }
    }
    public function retrieveBranchesWithGroups(Request $request){
        
    }
}
