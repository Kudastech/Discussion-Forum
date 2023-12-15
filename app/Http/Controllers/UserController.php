<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{




    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $idea = $user->ideas()->with('user:id,name,image')->paginate(5);

        return view('users.show', compact('user', 'idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $idea = $user->ideas()->with('user')->paginate(5);

        $editing = true;

        return view('users.edit', compact('user', 'editing', 'idea'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate([

            'name' => 'required|min:3|max:40',

            'bio' => 'nullable',

            'image' => 'image'

        ]);

        // dd($validated);

        if(request()->hasFile('image'))
        {

            $imagePath = request()->file('image')->store('profile', 'public');

            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
