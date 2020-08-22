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
        'а' => 'а',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'i',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shh',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'ju',
        'я' => 'ya',
    ];

    foreach ($customTransliteration as $letter => $transliteration) {
        $title = str_replace($letter, $transliteration, $title);
    }

    return Illuminate\Support\Str::slug($title, '-');
}
