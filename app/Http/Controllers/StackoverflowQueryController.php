<?php

namespace App\Http\Controllers;

use App\Models\StackoverflowQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StackoverflowQueryController extends Controller
{
    public function showQueries(Request $request) {
        if ($request->expectsJson()) {
            $data = StackoverflowQuery::query()->where('active', '=', true)->get(['regex', 'reason']);
            return response()->json($data);
        }
        else {
            $data = StackoverflowQuery::query()->join('users', 'stackoverflow_queries.creator', '=', 'users.id')->get(['stackoverflow_queries.id', 'stackoverflow_queries.regex', 'users.email', 'stackoverflow_queries.active', 'stackoverflow_queries.reason']);
            $isAdmin = Auth::user()->role == 0;
            return view('stackoverflow_queries', ['queries' => $data, 'isAdmin' => $isAdmin]);
        }
    }

    public function createQuery(Request $request) {
        StackoverflowQuery::query()->create([
            'sqlQuery' => '', // TODO
            'regex' => $request->get('newQuery'),
            'reason' => $request->get('newQueryReason'),
            'tags' => '', // TODO
            'creator' => $request->user()->id,
            'active' => true
        ]);
        return response()->redirectTo('/queries');
    }

    public function enableQuery(Request $request, $id) {
        $query = StackoverflowQuery::find($id);
        $query->active = true;
        $query->save();
        return response()->redirectTo('/queries');
    }

    public function disableQuery(Request $request, $id) {
        $query = StackoverflowQuery::find($id);
        $query->active = false;
        $query->save();
        return response()->redirectTo('/queries');
    }

    public function deleteQuery(Request $request, $id) {
        StackoverflowQuery::find($id)->delete();
        return response()->redirectTo('/queries');
    }
}