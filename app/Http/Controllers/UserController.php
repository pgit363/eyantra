<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getNames(Request $request)
    {
        Log::info("to show all data");
        $users = User::select('id','name')->get();
        Log::info($users);
        return response()->json($users, 200);        
    }

    public function getUsers(Request $request)
    {
        Log::info("to show all data".$request->id);

        $users = User::select('users.*', 'countries.name as country_name' , 'colleges.name as college_name')
        ->join('countries', 'users.country_id', '=', 'countries.id')
        ->join('colleges', 'users.college_id', '=', 'colleges.id')
        ->where('users.id', $request->id)
        ->get(); // or first() 

        // $users = User::where('id', $request->id)->get();
        Log::info($users);
        return response()->json($users, 200);        
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone' => 'required|numeric',
            'country_id' => 'required|numeric',
            'college_id' => 'required|numeric',
            'email' => 'required|string|email|max:100|unique:users',
            'gender' => 'required|string',
            'year' => 'required|date',
            'department' => 'required|regex:/^[a-zA-Z]+$/u'
        ]);

        if($validator->fails()){
            Log::info($validator->errors());
            return response()->json($validator->errors(), 400);       
        }
    
        $user = User::create($request->all());
        Log::info("User added successfully");
        return response()->json(['message'=>'User added successfully'], 200);        
    }
}
