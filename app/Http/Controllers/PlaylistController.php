<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PlaylistController extends Controller
{
    public function index() {
        $playlists = DB::table('playlists')
        ->get([
            'id',
            'name'
        ]); 
        
        return view('playlist.index', [
            'playlists' => $playlists 
        ]);
    }

    public function show($id) {
        $playlist = DB::table('playlists')
            ->where('id', '=', $id)
            ->first();

        $playlistTracks = DB::table('playlist_track')
            ->where('playlist_id', '=', $id)
            ->join('tracks', 'playlist_track.track_id', '=', 'tracks.id')
            ->join('albums', 'tracks.album_id', '=', 'albums.id')
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->join('genres', 'tracks.genre_id', '=', 'genres.id')
            ->get([
                'tracks.name AS track',
                'albums.title AS album',
                'artists.name AS artist',
                'genres.name AS genre'
            ]);

        // $playlistCount = DB::table('playlist_track')
        //     ->where('playlist_id', '=', $id)
        //     ->get('COUNT(track_id)');

        return view('playlist.show', [
            'playlist' => $playlist,
            'playlistTracks' => $playlistTracks,
            // 'playlistCount' => $playlistCount
        ]);
    }
}

