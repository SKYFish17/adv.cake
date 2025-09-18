<?php

/**
 * Переворачивает буквенные символы в строке,
 * оставляя небуквенные символы на своих местах
 * @param $inputStr
 * @return string
 */
function revertStr($inputStr): string
{
    $pattern = '/(\p{L}+|[^\p{L}]+)/u';
    $wordPattern = '/^\p{L}+$/u';
    $tokens = preg_split($pattern, $inputStr, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $resultStr = '';

    foreach ($tokens as $token) {
        if (preg_match($wordPattern, $token)) {
            $resultStr .= revertWordLetters($token);
        } else {
            $resultStr .= $token;
        }
    }

    return $resultStr;
}

    /**
     * Переворачивает буквы в слове с учетом регистра
     * @param string $word
     * @return string
     */
function revertWordLetters(string $word): string
{
    $letters = mb_str_split($word);
    $lettersRegister = [];

    foreach ($letters as $letter) {
        if (mb_strtoupper($letter) === $letter) {
            $lettersRegister[] = true;
        } else {
            $lettersRegister[] = false;
        }
    }

    $revertedLetters = array_reverse($letters);

    foreach ($revertedLetters as $key => &$revertedLetter) {
        if ($lettersRegister[$key]) {
            $revertedLetter = mb_strtoupper($revertedLetter);
        } else {
            $revertedLetter = mb_strtolower($revertedLetter);
        }
    }

    return implode($revertedLetters);
}

$testCases = [
    ['Cat', 'Tac'],
    ['Мышь', 'Ьшым'],
    ['houSe', 'esuOh'],
    ['домИК', 'кимОД'],
    ['elEpHant', 'tnAhPele'],
    ['cat,', 'tac,'],
    ['Зима:', 'Амиз:'],
    ["is 'cold' now", "si 'dloc' won"],
    ['это «Так» "просто"', 'отэ «Кат» "отсорп"'],
    ['third-part', 'driht-trap'],
    ['can`t', 'nac`t']
];

foreach ($testCases as $key => $case) {
    assert(revertStr($case[0]) === $case[1]);
}