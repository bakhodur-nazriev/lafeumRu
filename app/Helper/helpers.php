<?php

/**
 * Generates slug from $title
 * 
 * @param string $title
 * @return string
 */
function generateSlug($title)
{
    $customTransliteration = [
        'ё' => 'yo',
        'й' => 'i',
        'э' => 'e',
        'я' => 'ya'
    ];

    foreach ($customTransliteration as $letter => $transliteration) {
        $title = str_replace($letter, $transliteration, $title);
    }

    return Illuminate\Support\Str::slug($title);
}