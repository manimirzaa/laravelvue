<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class UserController extends Controller
{
    public function index(){
        
        $users = User::all();

        return $users;

    }

    public function view($user_id){
        $user = User::findOrFail($user_id);
        return $user;
    }

    public function store(Request $request){

        $user = User::create($request->all());

        return $user;

    }

    public function update(Request $request, $user_id){

        $user = User::findOrFail($user_id);
        $user->update($request->all());

        return $user;

    }

    public function destroy(Request $request, $user_id){

        $user = User::findOrFail($user_id);
        $user->delete($user);

        return $user;   
    }
}
