<?php
namespace App\Model;

class PigLatinTranslator
{
    private static $vowels = ['a', 'e', 'i', 'o', 'u'];

    public static function translate(string $input): string
    {
        $words = explode(' ', strtolower($input));
        $result = [];

        foreach ($words as $word) {
            $firstLetter = substr($word, 0, 1);
            $secondLetter = substr($word, 1, 1);

            if (in_array($firstLetter, self::$vowels) ||
                ($firstLetter == 'q' && $secondLetter == 'u')) {
                $translated = $word . 'ay';
            } else {
                $restOfWord = substr($word, 2);
                $translated = $restOfWord . $firstLetter . $secondLetter . 'ay';
            }

            $result[] = $translated;
        }

        return ucfirst(implode(' ', $result));
    }
}