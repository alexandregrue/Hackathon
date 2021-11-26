<?php

namespace App\Model;

class SongManager extends AbstractManager
{
    public const TABLE = 'song';

    public function selectRandomSong(string $askedLyricsList = null): array
    {
        if (!isset($askedLyricsList) || $askedLyricsList == null) {
            $query = ("SELECT * FROM " . static::TABLE . " " .
                "INNER JOIN lyrics ON song.id = lyrics.id_song " .
                "ORDER BY rand() LIMIT 1");
        } else {
            $query = ("SELECT * FROM " . static::TABLE . " " .
                "INNER JOIN lyrics ON song.id = lyrics.id_song " .
                "WHERE lyrics.id NOT IN (" . $askedLyricsList . ") " .
                "ORDER BY rand() LIMIT 1");
        }
        return $this->pdo->query($query)->fetch();
    }

    public function countAllSongs(): array
    {
        $query = ("SELECT COUNT(*) AS total FROM " . static::TABLE);
        return $this->pdo->query($query)->fetch();
    }
}
