<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 0;
        $user->save();
        return redirect('users');
    }

    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 1;
        $user->save();
        return  redirect('users');
    }

    public function addRequest($id)
    {
        $user = User::findOrFail($id);
        $pending = $user->pending;
        $user->pending = $pending + 1;
        $user->save();
    }

    public function acceptRequest($id)
    {
        $user = User::findOrFail($id);
        $accepted = $user->accepted;
        $pending = $user->pending;
        $user->pending = $pending - 1;
        $user->accepted = $accepted + 1;
        $user->save();
    }

    public function rejectRequest($id)
    {
        $user = User::findOrFail($id);
        $rejected = $user->rejected;
        $pending = $user->pending;
        $user->pending = $pending - 1;
        $user->rejected  = $rejected + 1;
        $user->save();
    }

    public function showUsers(){
        $data = User::all();
        return view('users',['users'=>$data]);
    }

    public function userProfile(){
        $user = Auth::user();
            return view('userProfile',['user'=>$user]);
    }
}
