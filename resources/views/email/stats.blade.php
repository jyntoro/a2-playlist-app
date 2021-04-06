@extends('layouts.email')

@section('content')
    <div class="card text-dark bg-info mb-3">
        <div class="card-body">
        <h5 class="card-title">Statistics</h5>
        <p class="card-text">
            <b>{{ $num_of_playlists }}</b> number of playlists<br>
            <b>{{ $num_of_artists }}</b> number of artists<br>
            <b>{{ $total_track_length }}</b> minutes of tracks<br>
        </p>
        </div>
    </div>
    
@endsection