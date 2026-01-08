<?php

require_once("FileInformation.php");
require_once("ExtensionDetector.php");

class Uploader
{
    private $name;
    private $type;
    public $directory = '';
    // attributs ci-dessous rajouté car la création dynamique de propriétés est déprécié en PHP 8.2
    private ?string $error = null;
    private string $temporaryName;
    private ExtensionDetector $extensionDetector;

    public function __construct($file)
    {
        $fileData = $_FILES[$file];
        $this->temporaryName = $fileData['tmp_name'];
        $this->name = $fileData['name'];
        $this->type = $fileData['type'];
        $this->extensionDetector = new ExtensionDetector();
    }

    public function uploadFile()
    {
        if (!$this->extensionDetector->isValidType($this->type)) {
            $this->error = 'Le fichier ' . $this->name . ' n\'est pas d\'un type valide';

            return false;
        } else {
            return true;
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getExtension()
    {
        $fileInformation = new FileInformation();

        return $fileInformation->getExtension($this->name);
    }

    public function resize($origin, $destination, $width, $maxHeight)
    {
        $imageResizer = new ImageResizer();
        $imageResizer->resize($this->getExtension(), $origin, $destination, $width, $maxHeight); 
    }
}
