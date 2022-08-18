<?php

namespace App\Http\Controllers;

use App\Models\UnreportedPost;

class UnreportedPostController extends Controller
{
    public function addUnreportedPost($postId)
    {
        if ($this->isUnreported($postId)) {
            return;
        }
        UnreportedPost::create([
            'soPostId' => $postId
        ]);
    }

    public function removeUnreportedPost($postId)
    {
        if (!$this->isUnreported($postId)) {
            return;
        }
        UnreportedPost::query()->firstWhere('soPostId', '=', $postId)->delete();
    }

    public function isUnreported($postId) {
        return UnreportedPost::query()->firstWhere('soPostId', '=', $postId) != null;
    }

    public function filterUnreported($ids) {
        return UnreportedPost::query()->whereIn('soPostId', $ids)->pluck('soPostId');
    }
}
