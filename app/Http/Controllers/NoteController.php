<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(4);
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:30',
            'content' => 'required'
        ]);

        Note::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('notes.index')->with('success','Note Added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        //
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->firstOrFail();
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        //
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->firstOrFail();
        return view('notes.edit')->with('note', $note);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        //
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->firstOrFail();
        $request->validate([
            'title'=> 'required|max:30',
            'content' => 'required',
         ]);
        $note->update([
            'title' => $request->title,
            'content'=> $request->content,
            'updated_at'=> Carbon::now(),
            ]);
        return redirect()->route('notes.show',$note->uuid)->with('success','Note has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        //
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->firstOrFail();
        $note->delete();

        return redirect()->route('notes.index')->with('success','Note has been deleted!');
    }
}
