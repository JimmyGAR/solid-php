<?php

require_once("UnknowExtensionException.php");

// Si on ajoute un nouveau format, cette classe ne change plus :-)
class MusicReader
{
    private $musicType;

    public function __construct(MusicType $musicType)
    {
        $this->musicType = $musicType;

        $extension = pathinfo($this->musicType->getFilename(), PATHINFO_EXTENSION);
        
        if (empty($extension)) {
            throw new UnknowExtensionException('Les fichiers sans extension ne sont pas acceptés.');
        }
    }

    public function listen()
    {
        return $this->musicType->listen();
    }
}