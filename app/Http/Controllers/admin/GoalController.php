<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoalController extends Controller
{
    public function GoalList(){
        $getRecord = GoalModel::get();
        Session::put('page', 'goal');

        return view('admin.goal.list')->with(compact('getRecord'));
    }
    public function goalAdd(){
        return view('admin.goal.add');

    }
    public function goalInsert(Request $request){

        $insert_goal = request()->validate([
            'name' => 'required',
            'target_value' => 'required|integer',
        ]);
        $insert_goal = new GoalModel;
        $insert_goal->name = trim($request->name);
        $insert_goal->target_value = trim($request->target_value);
        $insert_goal->save();
        return redirect('admin/goal-list')->with('success_message','Record successfully create');
    }
}
