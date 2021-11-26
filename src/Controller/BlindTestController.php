<?php

namespace App\Controller;

use App\Model\BlindTestManager;

class BlindTestController extends AbstractController
{
    public function getSong()
    {
        $songManager = new BlindTestManager();

        if (!isset($_SESSION["MusicWellAnswered"])) {
            $_SESSION["MusicWellAnswered"] = [];
        }

        if (empty($_SESSION["MusicWellAnswered"])) {
            //if it's the beginning of the session, we select a random question
            $song = $songManager->selectRandomSong();
        } else {
            // Transform the array into a string to send it as a parameter for the SQL request
            $askedMusic = implode(",", $_SESSION["MusicWellAnswered"]);
            $song = $songManager->selectRandomSong($askedMusic);
        }
        if (isset($song["id"])) {
            // Stock the variables in $_Session to fetch them in the result page
            $_SESSION["song"] = $song;
            return $this->twig->render('BlindTest/blindTest.html.twig', [
                'song' => $song,
                'session' => $_SESSION,
            ]);
        }
    }

    public function verifyAnswerBlind()
    {
        // This verify is the answer sent is correct. If the form is valid it will check word by word
        // if the answer is correct, and then an array in the json format. Otherwise it returns an error.
        // (For now only that the answer doesn't have the correct amount of words.)
        if (isset($_SESSION["song"]) && isset($_GET["title"])  && isset($_GET["artist"])) {
            $artistinDB = strtolower(trim($_SESSION["song"]["artist"]));
            $titleinDB = strtolower(trim($_SESSION["song"]["title"]));
            $artist = strtolower(trim($_GET["artist"]));
            $title = strtolower(trim($_GET["title"]));
            $response = "";
            if ($artistinDB == $artist && $titleinDB == $title) {
                $_SESSION['score'] += 3;
                $response = "The title and artist are corrects";
            } elseif ($titleinDB == $title) {
                $_SESSION['score'] += 1;
                $response = "Just the title is correct";
            } elseif ($artistinDB == $artist) {
                $_SESSION['score'] += 1;
                $response = "Just the artist is correct";
            } else {
                $response = "Sorry both of your answers are wrong";
            }


            return json_encode([$response]);
        } else {
            return json_encode([false]);
        }
    }
}
