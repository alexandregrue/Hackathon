<?php

namespace App\Controller;

class SuccessController extends AbstractController
{
    public function success()
    {
        unset($_SESSION["lyricsWellAnswered"]);
        unset($_SESSION['score']);
        return $this->twig->render('Song/success.html.twig');
    }
}
