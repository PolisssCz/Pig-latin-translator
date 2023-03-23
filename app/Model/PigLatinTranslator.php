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
            // Najdeme pozici první samohlásky ve slově za případným "qu"
            $quPos = strpos($word, 'qu');
            $firstVowelPos = false;
            if ($quPos !== false && $quPos < strlen($word) - 1) {
                $firstVowelPos = strcspn(substr($word, $quPos + 2), 'aeiou') + $quPos + 2;
            }
            if ($firstVowelPos === false) {
                // Slovo začíná souhláskovým shlukem nebo "qu"
                $firstVowelPos = strcspn($word, 'aeiou');
            }
            if ($firstVowelPos === 0) {
                // Slovo začíná samohláskou
                $translated = $word . 'ay';
            } else {
                // Slovo začíná souhláskovým shlukem nebo "qu"
                $prefix = substr($word, 0, $firstVowelPos);
                $restOfWord = substr($word, $firstVowelPos);
                $translated = $restOfWord . $prefix . 'ay';
            }

            $result[] = $translated;
        }

        // Sestavíme výslednou větu a vrátíme ji
        return implode(' ', $result);
    }
}