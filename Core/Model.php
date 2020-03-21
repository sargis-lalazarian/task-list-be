<?php

class Model
{
    protected function cleanUpText($text)
    {
        $text = htmlspecialchars($text, ENT_IGNORE, 'utf-8');
        $text = strip_tags($text);
        $text = stripslashes($text);
        return $text;
    }
}
