<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        // $user = auth()->user();

        $followingIDs = auth()->user()->followings()->pluck('user_id');

        $ideas = Idea::whereIn('user_id', $followingIDs)->latest();

        if(request()->has('search'))
        {
            $ideas = $ideas->where('content', 'like' , '%'. request()->get('search', '') . '%');
        }

        $idea = $ideas->paginate(5);

        return view('dashboard', compact('idea'));
    }
}
