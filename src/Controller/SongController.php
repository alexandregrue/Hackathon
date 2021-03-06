<?php

namespace App\Controller;

use App\Model\SongManager;

class SongController extends AbstractController
{
    public function show()
    {
        // Copyright Morgane
        $songManager = new SongManager();

        if (!isset($_SESSION["lyricsWellAnswered"])) {
            $_SESSION["lyricsWellAnswered"] = [];
        }
        // three if
        if (empty($_SESSION["lyricsWellAnswered"])) {
            //if it's the beginning of the session, we select a random question
            $song = $songManager->selectRandomSong();
        } else {
            // Transform the array into a string to send it as a parameter for the SQL request
            $askedLyricsList = implode(",", $_SESSION["lyricsWellAnswered"]);
            $song = $songManager->selectRandomSong($askedLyricsList);
        }

        if (isset($song['id'])) {
            // Stock the variables in $_Session to fetch them in the result page
            $_SESSION["song"] = $song;
            return $this->twig->render('Song/index.html.twig', [
                'song' => $song,
                'session' => $_SESSION,
            ]);
        }
    }
}
