<?php

namespace App\Controller;

use App\Model\SongManager;

class SongController extends AbstractController
{
    public function getSong()
    {
        // Copyright Morgane
        $songManager = new SongManager();
        $count = $songManager->countAllSongs();
        $countTotal = intval($count['total']);

        //initialize SESSION score et lyricsWellAnswered if not setted
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }
        if (!isset($_SESSION["lyricsWellAnswered"])) {
            $_SESSION["lyricsWellAnswered"] = [];
        }

        if (empty($_SESSION["lyricsWellAnswered"])) {
            //if it's the beginning of the session, we select a random question
            $song = $songManager->selectRandomSong();
        } elseif (
            (!empty($_SESSION["lyricsWellAnswered"]) && (count($_SESSION["lyricsWellAnswered"]) < $countTotal))
        ) {
            // Transform the array into a string to send it as a parameter for the SQL request
            $askedLyricsList = implode(",", $_SESSION["lyricsWellAnswered"]);
            $song = $songManager->selectRandomSong($askedLyricsList);
        } elseif (
            !empty($_SESSION["lyricsWellAnswered"]) && (count($_SESSION["lyricsWellAnswered"]) == $countTotal)
        ) {
            header("Location:/success");
        }

        if (isset($song["id"])) {
            // Stock the variables in $_Session to fetch them in the result page
            $numberOfWords = substr_count($song["lyrics_to_guess"], " ");
            $_SESSION["song"] = $song;
            return $this->twig->render('Song/game.html.twig', [
                'song' => $song,
                'session' => $_SESSION,
                'numberOfWords' => $numberOfWords,
            ]);
        }
    }

    public function verifyAnswer()
    {
        // This verify is the answer sent is correct. If the form is valid it will check word by word
        // if the answer is correct, and then an array in the json format. Otherwise it returns an error.
        // (For now only that the answer doesn't have the correct amount of words.)
        if (isset($_SESSION["song"]) && isset($_GET["answer"])) {
            $arraySongAnswer = explode(" ", trim($_SESSION["song"]["lyrics_to_guess"]));
            $arrayUserAnswer = explode(" ", $_GET["answer"]);
            $arrayCorrection = []; // This will return a keyed array [string "word" and bool "is correct"]
            $answerisCorrect = true;

            if (count($arraySongAnswer) != count($arrayUserAnswer)) {
                return json_encode([false]);
            }

            foreach ($arrayUserAnswer as $index => $word) {
                if (strtolower($word) === strtolower($arraySongAnswer[$index])) {
                    $arrayCorrection[] = [$word, true];
                } else {
                    // We check this to send if the page has to show the right lyrics below the answer.
                    $arrayCorrection[] = [$word, false];
                    $answerisCorrect = false;
                }
            }

            if ($answerisCorrect && isset($_SESSION["lyricsWellAnswered"]) && isset($_SESSION['song']['id'])) {
                // Todo: put the lyrics id in $_SESSION["lyricsWellAnswered"]
                $_SESSION["lyricsWellAnswered"][] = $_SESSION['song']['id'];
                $_SESSION['score'] ++;
            }
            return json_encode([$arrayCorrection, $answerisCorrect, $_SESSION["song"]["lyrics_to_guess"]]);
        } else {
            return json_encode([false]);
        }
    }
}
