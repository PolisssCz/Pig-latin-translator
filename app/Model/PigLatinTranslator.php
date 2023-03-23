<?php
namespace App\Model;

class PigLatinTranslator
{
    public static function translate(string $input): string
    {
        // Rozdělíme vstup na slova a převedeme je na malá písmena
        $words = explode(' ', strtolower($input));
        $result = [];

        foreach ($words as $word) {
            // Najdeme pozici první samohlásky ve slově
            $firstVowelPos = strpos($word, 'a') ?: strpos($word, 'e') ?: strpos($word, 'i') ?: strpos($word, 'o') ?: strpos($word, 'u');

            if ($firstVowelPos === false || $firstVowelPos === 0) {
                // Slovo začíná souhláskovým shlukem nebo žádnou samohláskou
                $translated = $word . 'ay';
            } else {
                // Slovo začíná samohláskou
                $prefix = substr($word, 0, $firstVowelPos);
                $restOfWord = substr($word, $firstVowelPos);
                $translated = $restOfWord . $prefix . 'ay';
            }

            $result[] = $translated;
        }

        // Sestavíme výslednou větu a vrátíme ji
        return ucfirst(implode(' ', $result));
    }
}