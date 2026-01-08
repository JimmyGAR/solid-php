<?php

require_once 'MusicType.php';
require_once("InvalidExtensionException.php");

class Ogg extends MusicType
{
    public function listen()
    {
        $extension = pathinfo($this->filename, PATHINFO_EXTENSION);
        if ($extension !== 'ogg') {
            throw new InvalidExtensionException("Fichier Ogg attendu mais ''$extension'' obtenu");
        }

        return 'Lecture du fichier Ogg '. $this->filename;
    }
}
