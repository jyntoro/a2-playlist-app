<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TrackController extends Controller
{
    public function index() {
        $tracks = DB::table('tracks')
            ->join('albums', 'tracks.album_id', '=', 'albums.id')
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->join('genres', 'tracks.genre_id', '=', 'genres.id')
            ->join('media_types', 'tracks.media_type_id', '=', 'media_types.id')
            ->get([
                'tracks.name AS name',
                'albums.title AS album',
                'artists.name AS artist',
                'media_types.name AS media_type',
                'genres.name AS genre',
                'unit_price'
            ]);

        return view('track.index', [ 
            'tracks' => $tracks
        ]); 
    }

    public function create() { 
        $albums = DB::table('albums')
            ->orderBy('title')
            ->get();
        
        $media_types = DB::table('media_types')
            ->orderBy('name')
            ->get();
        
        $genres = DB::table('genres')
            ->orderBy('name')
            ->get();

        return view('track.create', [
            'albums' => $albums,
            'media_types' => $media_types,
            'genres' => $genres
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'album' => 'required|exists:albums,id',
            'media_type' => 'required|exists:media_types,id',
            'genre' => 'required|exists:genres,id',
            'unit_price' => 'required|numeric'
        ]);

        $artists = DB::table('tracks')->insert([
            'name' => $request->input('name'),
            'album_id' => $request->input('album'),
            'media_type_id' => $request->input('media_type'),
            'genre_id' => $request->input('genre')
        ]);

        return redirect()->route('track.index')
        // creates a variable called 'success'
        // sets the variable w/ the message that can be displayed once (flashed session data)
            ->with('success', "The track {$request->input('name')} was successfully created");
    }

}
