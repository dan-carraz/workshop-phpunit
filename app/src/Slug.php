<?php

namespace App;

/**
 * Class Slug
 */
class Slug
{
    /**
     * @param string $string
     * @param string $separator
     * @param int $maxLength
     * @return string
     */
    public function sluggify(string $string, string $separator = '-', int $maxLength = 96): string
    {
        $title = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $title = preg_replace("%[^-/+|\w ]%", '', $title);
        $title = strtolower(trim(substr($title, 0, $maxLength), '-'));
        $title = preg_replace("/[\/_|+ -]+/", $separator, $title);

        return $title;
    }
}
