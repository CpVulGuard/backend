<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use App\Models\Post;
use App\Models\PostTmp;
use Illuminate\Http\Request;

class PostTmpController extends Controller
{
    /**
     * Show import preview
     */
    public function showImport()
    {
        $data = PostTmp::query()->orderBy('soPostId')->take(1000)->get(); // limit preview to 1000 entries
        return $data->isEmpty() ? redirect('/import') : view('viewImport', ['posts' => $data]);
    }

    /**
     * Clear previous import attempt and show import page
     */
    public function initImport()
    {
        PostTmp::query()->delete(); // clear preview posts
        return view('file-import');
    }

    /**
     * Handle import file upload
     */
    public function fileImport(Request $request)
    {
        $file = $request->file('file')->store('temp');
        $reason = $request->request->get('reason');
        (new PostsImport())->fromFile($file, $reason); // handle file import
        return redirect('/import-view');
    }

    /**
     * Write imported file to database
     */
    public function finishImport(Request $request)
    {
        $last_id = 0; // last processed soPostId
        $data = array(); // processed data for bulk insertion
        while (($part = PostTmp::query()->where('soPostId', '>', $last_id)->orderBy('soPostId')->take(1000)->get())->isNotEmpty()) {
            foreach ($part as $post) {
                $data[] = [
                    'soPostId' => $post->soPostId,
                    'reason' => $post->reason,
                    'imported' => true,
                    'codeBlockIndex' => -1,
                    'rows' => -1
                ];
            }
            $last_id = $part->last()->soPostId; // update id for next query
            Post::query()->insertOrIgnore($data); // bulk insert
            $data = array(); // clear processed data
        }
        PostTmp::query()->delete(); // clear preview posts
        return redirect('/dashboard');
    }
}
