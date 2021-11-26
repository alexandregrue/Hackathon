<?php

namespace App\Controller;

class BenjaminController extends AbstractController
{
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
