<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use App\Models\Artist;


class AlbumController extends Controller
{
    public function index() {

        // $this->authorize('viewAny');

        return view('album.index', [ // corresponds to a folder in the views folder
            'albums' => Album::join('artists', 'artists.id', '=', 'albums.artist_id')
            ->join('users', 'users.id', '=', 'albums.user_id')
            ->with(['artist', 'user'])
            ->orderBy('artists.name')
            ->orderBy('title')
            ->select('*', 'albums.id as id')
            ->get()
        ]); 
        
    }

    public function create() { 
        
        return view('album.create', [
            'artists' => Artist::orderBy('name')->get()
        ]);

    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:50',
            'artist' => 'required|exists:artists,id',
        ]);

        $album = new Album();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->user_id = Auth::user()->id;
        $album->save();
        
        return redirect()->route('album.index')
        // creates a variable called 'success'
        // sets the variable w/ the message that can be displayed once (flashed session data)
            ->with('success', "Successfully created {$request->input('title')}");
    }

    public function edit($id) {
        $artists = Artist::orderBy('name')->get();

        $album = Album::find($id);

        if (!Auth::user()->can('view', $album)) {
            abort(403);
        }

        return view('album.edit', [
            'artists' => $artists,
            'album' => $album
        ]);
    }

    public function update($id, Request $request) {
        $request->validate([
            'title' => 'required|max:50',
            'artist' => 'required|exists:artists,id',
        ]);
        
        $album = Album::where('id', '=', $id)->first();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->save();

        $this->authorize('view', $album);

        return redirect()
            ->route('album.edit', [ 'id' => $id ])
            ->with('success', "Successfully updated {$request->input('title')}");

    }
}
