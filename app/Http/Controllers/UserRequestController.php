<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller {
    public function index() {
        $data = UserRequest::all();
        return view('user-requests', ['userRequests'=>$data]);
    }

    public function store(Request $request) {
        $user_id = Auth::id();
        UserRequest::create([
            'user_id' => $user_id,
            'soPostId' => $request->json("soPostId"),
            'reason' => $request->json("reason"),
            'codeBlockIndex' => $request->json("codeBlockIndex"),
            'rows' => $request->json("rows"),
            'type' => $request->json("type"),
            'realTime' => $request->json("realTime")
        ]);
        return [];
    }

    public function accept($id) {
        $userRequest = UserRequest::findOrFail($id);
        if($userRequest->type == "add") {
            Post::create([
                'soPostId' => $userRequest->soPostId,
                'reason' => $userRequest->reason,
                'codeBlockIndex' => $userRequest->codeBlockIndex,
                'rows' => $userRequest->rows
            ]);
        }
        elseif ($userRequest->type == "delete")
        {
            if ($userRequest->realTime) {
                app('App\Http\Controllers\UnreportedPostController')->addUnreportedPost($userRequest->soPostId);
            }
            app('App\Http\Controllers\PostController')->deleteBySoPostId($userRequest->soPostId);
        }
        else {
            abort(500, "Type not supported");
        }
        app('App\Http\Controllers\UserController')->acceptRequest($userRequest->user_id);
        $userRequest->delete();
        return redirect('request');
    }

    public function reject($id) {
        $userRequest = UserRequest::findOrFail($id);
        app('App\Http\Controllers\UserController')->rejectRequest($userRequest->user_id);
        $userRequest->delete();
        return redirect('request');
    }
}
