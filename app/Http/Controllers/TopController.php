<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'owners' => User::whereHas('topics')->get(),
            'authors' => User::whereHas('articles')->get(),
            'comment_authors' => User::whereHas('comments')->get(),
        ]);
    }

    public function top10comments(Request $request)
    {
        return Comment::whereHas('article', static function ($query) use (&$request) {
            $query->whereHas('topic', static function ($query) use (&$request) {
                $query->where('owner_id', $request->owner);
            });
        })->orderBy('mark', 'desc')->limit(10)->get();
    }

    public function topNComments(Request $request)
    {
        return Comment::whereHas('article', static function ($query) use (&$request) {
            $query->whereHas('topic', static function ($query) use (&$request) {
                $query->where('owner_id', $request->owner);
            })->where('author_id', $request->author);
        })->orderBy('mark', 'desc')->limit($request->limit)->get();
    }

    public function ownersByCommentAuthor(Request $request)
    {
        return User::whereHas('topics', static function ($query) use (&$request) {
            $query->whereHas('articles', static function ($query) use (&$request) {
                $query->whereHas('comments', static function ($query) use (&$request) {
                    $query->where('author_id', $request->author);
                });
            });
        })->get();
    }
}
