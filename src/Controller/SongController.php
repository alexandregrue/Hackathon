<?php

namespace App\Controller;

use App\Model\SongManager;

class SongController extends AbstractController
{
    public function getSong()
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

        if (isset($_SESSION["song"])) {
            // Stock the variables in $_Session to fetch them in the result page
            $numberOfWords = substr_count($song["lyrics_to_guess"], " ");
            $time1 = '5s';
            $time2 = '5s';
            $_SESSION["song"] = $song;
            return $this->twig->render('Song/game.html.twig', [
                'song' => $song,
                'session' => $_SESSION,
                'numberOfWords' => $numberOfWords,
                'time1' => $time1,
                'time2' => $time2,
            ]);
        }
    }

    public function verifyAnswer()
    {
        if (isset($_SESSION["song"]) && isset($_POST["user_answer"])) {
            $arraySongAnswer = explode(" ", $_SESSION["song"]);
            $arrayUserAnswer = explode(" ", $_POST["user_answer"]);
            $arrayCorrection = []; // This will return a keyed array [string "word" and bool "is correct"]

            if (count($arraySongAnswer) != count($arrayUserAnswer)) {
                return "";
            }

            foreach ($arrayUserAnswer as $index => $word) {
                if ($word === $arraySongAnswer[$index]) {
                    $arrayCorrection[] = [$word, true];
                } else {
                    $arrayCorrection[] = [$word, true];
                }
            }

            return json_encode($arrayCorrection);
        } else {
            return "";
        }
    }
}
