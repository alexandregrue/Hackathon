<?php

namespace App\Controller;

use App\Model\BlindTestManager;

class BlindTestController extends AbstractController
{
    public function getSong()
    {
        // Copyright Morgane
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
        var_dump($song);
        if (isset($song["id"])) {
            // Stock the variables in $_Session to fetch them in the result page
            $_SESSION["song"] = $song;
            var_dump($_SESSION["song"]["artist"]);
            var_dump($_POST);
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
        var_dump($_GET["answer"]);
        if (isset($_SESSION["song"]) && isset($_GET["title"])  && isset($_GET["artist"])) {
            $artistinDB = strtolower(trim($_SESSION["song"]["artist"]));
            $titleinDB = strtolower(trim($_SESSION["song"]["title"]));
            $artist = strtolower(trim($_GET["artist"]));
            $title = strtolower(trim($_GET["title"]));

            if ($artistinDB == $artist && $titleinDB == $title) {
               
            } 

        
            if (count($arraySongAnswer) != count($arrayUserAnswer)) {
                return json_encode([false]);
            }

            foreach ($arrayUserAnswer as $index => $word) {
                if ($word === $arraySongAnswer[$index]) {
                    $arrayCorrection[] = [$word, true];
                } else {
                    // We check this to send if the page has to show the right lyrics below the answer.
                    $arrayCorrection[] = [$word, false];
                    $answerisCorrect = false;
                }
            }

            if ($answerisCorrect) {
                // Todo: put the lyrics id in $_SESSION["lyricsWellAnswered"]
            }
            return json_encode([$arrayCorrection, $answerisCorrect, $_SESSION["song"]["lyrics_to_guess"]]);
        } else {
            return json_encode([false]);
        }
    }
}
