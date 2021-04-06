<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Playlist;
use App\Models\Artist;
use App\Models\Track;

class Stats extends Mailable
{
    use Queueable, SerializesModels;

    public $num_of_playlists;
    public $num_of_artists;
    public $total_track_length;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->num_of_playlists = Playlist::all()->count();
        $this->num_of_artists = Artist::all()->count();
        $total_track_length = Track::all()->sum('milliseconds');
        $this->total_track_length = round($total_track_length/60000);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.stats');
    }
}
