<?php

class Page_Data {
    public $title = "";
    public $content = "";
    public $css = "";
    public $embeddedStyle = "";
    public $js = "";

    public function addJS($src ) {
        $this->js .= "<script src='$src'></script>";
    }

    public function addCSS( $href ) {
        $this->css .= "<link href='$href' rel='stylesheet' />";
    }
}