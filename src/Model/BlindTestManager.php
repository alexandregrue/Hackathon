<?php

namespace App\Model;

class BlindTestManager extends AbstractManager
{
    public const TABLE = 'blind_test';

    public function selectRandomSong(string $askedMusic = null): array
    {
        if (!isset($askedLyricsList) || $askedLyricsList == null) {
            $query = ("SELECT * FROM " . static::TABLE . " " .
                "ORDER BY rand() LIMIT 1");
        } else {
            $query = ("SELECT * FROM " . static::TABLE . " " .
                "WHERE id NOT IN (" . $askedMusic . ") " .
                "ORDER BY rand() LIMIT 1");
        }
        return $this->pdo->query($query)->fetch();
    }
}
