<?php

namespace App\Http\Controllers;

use App\Models\Idea;

use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function show(Idea $ideas)

    {
        return view('idea.show', compact('ideas')
        );

    }

    public function store()
    {
       $validate = request()->validate([

            'content' => 'required|min:3|max:240'

        ]);

        $validate['user_id'] = auth()->id();

        Idea::create($validate);

        return redirect()->route('dashboard')->with('success', 'Idea Created Successfully');
    }


    public function destroy(Idea $idea)
    {

        $this->authorize('idea-delete', $idea);

        $idea->delete();

        return redirect()->back()->with('error', 'Idea Deleted Sucecessfully !');

    }

    public function edit(Idea $idea)
    {

        $this->authorize('idea-delete', $idea);


        $editing = true;

        return view('idea.show', compact('$idea', 'editing'));
    }

    public function update(Idea $idea)
    {
   
        $this->authorize('idea-edit', $idea);

       $validate = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        $idea->update($validate);

        return redirect()->route('idea.show', $idea->id)->with('success', 'Idea Updated Successfully!');

    }
}
