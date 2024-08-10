<?php
session_start();
include_once('connexiondb.php');

function get_image($path = ''):string
{
    if(file_exists($path))
    {
        return $path;
    }

    return './images/no-image.jpg';
}