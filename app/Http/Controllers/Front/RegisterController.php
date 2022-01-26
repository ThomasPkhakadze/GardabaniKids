<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kid;
use App\Models\KindergardenBranch;
use App\Models\KindergardenGroup;
use App\Models\ParentGuardian;
use Carbon\Carbon;


class RegisterController extends Controller
{
    public function register(Request $request){
        // Validate
        // dd($request);

        // Create

        // Checking if parent exists
        $parentGuardian = ParentGuardian::where('id_number',$request->parent_id_number)->first();
        if($parentGuardian == null){
            // If not creating a new one
            // dd($request);
            $parentGuardian = ParentGuardian::create([
                'name' => $request->parent_name,
                'lastname' => $request->parent_lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'id_number' => $request->parent_id_number,
                'guardian_type' => $request->guardian_type,
            ])->first(); 
        }
        // dd($parentGuardian);
        $test = Carbon::parse($request->date_of_birth)->format('Y-m-d');
        // dd($test, $request->date_of_birth);
        Kid::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'id_number' => $request->id_number,
            'date_of_birth' => $test,
            'parent_guardian_id' => $parentGuardian->id,
            'branch_id' => $request->branch_id,
            'group_id' => $request->group_id,

        ]);
        KindergardenGroup::find($request->group_id)->decrement('vacancy', 1);        
        // redirect with message
        return json_decode('123');
    }

    public function getBranches($page = 0)
    {
        $branches = KindergardenBranch::skip($page * 20)->take(20)->pluck('id', 'name')->all();
        return $branches;
    }

    public function getBranchGroups(Request $request)
    {
        $groups = KindergardenGroup::where([['kindergarden_branch_id', $request->id],['vacancy', '!=', '0']])->pluck('id', 'name')->all();
        return json_encode($groups);
    }
    public function checkIfRegistered(Request $request){
        $kid = Kid::where('id_number', $request->id_number)->with('branch')->first();
        if($kid != null){
            echo json_encode(['status' => 'Found', 'kid' => ['name' => $kid->name, 'lastname' => $kid->lastname, 'branch' => $kid->branch->name]]);
        }else{
            return json_encode(['status' => 'Not Found']);
        }
    }
    public function retrieveBranchesWithGroups(){
        $branch = KindergardenBranch::with('kindergardenBranchKindergardenGroups')->get();
        return json_encode($branch);
    }
}
