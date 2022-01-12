<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use App\Models\Post;
use App\Models\PostTmp;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostTmpController extends Controller
{
    public function showImport()
    {
        $data = PostTmp::all();

        if($data->isEmpty())
        {
            return redirect('/import');
        }

        return view('viewImport',['posts'=>$data]);
    }

    public function initImport()
    {
        foreach (PostTmp::all() as $post)
        {
            $post->delete();
        }
        return view('file-import');
    }

    public function fileImport(Request $request)
    {
        $file = $request->file('file')->store('temp');
        $fileName = $request->file('file')->getClientOriginalName();
        $reason = $request->request->get('reason');
        $import = (new PostsImport())->fromFile($fileName, $reason);
        $import->import($file);
        return redirect('/import-view');
    }

    public function finishImport(Request $request)
    {
        foreach (PostTmp::all() as $post)
        {
            try {
                Post::where('soPostId', "=", $post->soPostId)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                Post::create([
                    'soPostId' => $post->soPostId,
                    'reason' => $post->reason,
                    'imported' => true,
                    'codeBlockIndex' => -1,
                    'rows'=> -1
                ]);
            }
            $post->delete();
        }
        return redirect('/dashboard');
    }
}
