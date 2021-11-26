<?php

namespace App\Controller;

class SuccessController extends AbstractController
{
    public function success()
    {
        unset($_SESSION["lyricsWellAnswered"]);
        return $this->twig->render('Song/success.html.twig');
    }
}
