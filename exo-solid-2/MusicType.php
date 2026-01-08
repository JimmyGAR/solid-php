<?php 

abstract class MusicType {
    protected string $filename;
    public function __construct(string $filename) { $this->filename = $filename; }
    abstract public function listen();
}