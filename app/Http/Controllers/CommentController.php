<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Models\Idea;

use Illuminate\Http\Request;
class CommentController extends Controller
{
    public function store(Idea $ideas)

    {
        $comment = new Comment();

        $comment->idea_id = $ideas->id;

        $comment->user_id = auth()->id();

        $comment->content = request()->get('content');

        $comment->save();

        return redirect()->route('idea.show', $ideas->id)->with('success', 'Comment Posted successfully');
    }
}
