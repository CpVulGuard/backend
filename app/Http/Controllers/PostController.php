<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Post::create($request->json()->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->json()->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.

     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return 204;
    }

    public function showDashboard(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $posts = Post::sortable()
                ->where('soPostId', 'like', '%'.$filter.'%')
                ->paginate(100);
        } else {
            $posts = Post::sortable()->paginate(100);
        }

        return view('dashboard',['posts'=>$posts, 'filter'=>$filter]);
    }

    public function deleteBySoPostId($soPostId)
    {
        $post =  Post::where('soPostId', "=", $soPostId)->firstOrFail();
        $post->delete();
    }

    public function check(Request $request)
    {
        $foundPosts = array();
        $data = $request->json()->all();
        $ids = $data['ids'];
        foreach ($ids as &$soPostId) {
            try {
                $post =  Post::where('soPostId', "=", $soPostId)->firstOrFail();
                array_push($foundPosts, $post);
            } catch (ModelNotFoundException $e)
            {

            }
        }
        return response()->json($foundPosts);
    }
}
