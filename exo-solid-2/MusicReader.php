<?php

// Si on doit supporter un nouveau type de format, on doit modifier cette classe :(
require_once 'Mp3.php';
require_once 'Ogg.php';

class MusicReader
{
    private $filename;
    private $extension;
    private $musicType;
    private static array $type = [
        'mp3' => Mp3::class,
        'ogg' => Ogg::class,
    ];

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!isset(self::$type[$this->extension])) {
            throw new Exception("Format non supporté : $this->extension");
        }
        $class = self::$type[$this->extension];
        $this->musicType = new $class($filename);
    }

    public function listen()
    {
        $this->musicType->listen();
    }
}