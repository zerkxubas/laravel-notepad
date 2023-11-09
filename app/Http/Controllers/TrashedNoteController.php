<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    //
    public function index(){
                    // By using Eloquent Way
        //$notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(4);

        // Most common way
        $notes = Note::where('user_id', Auth::id())
                    ->onlyTrashed()
                    ->latest('updated_at')
                    ->paginate(4);
        return view('notes.index')->with('notes', $notes);
    }

    public function show($uuid){
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->onlyTrashed()->firstOrFail();
        return view('notes.show')->with('note', $note);
    }

    public function update($uuid){
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->onlyTrashed()->firstOrFail();
        $note->restore();
        return redirect()->route('notes.index')->with('success','Note restored successfully!');
    }

    public function destroy($uuid){
        $note = Note::where('uuid',$uuid)->where('user_id', Auth::id())->onlyTrashed()->firstOrFail();
        $note->forceDelete();
        return redirect()->route('trash.view')->with('success','Note has been permanently deleted!');

    }
}
