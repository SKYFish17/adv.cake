<?php
require_once './src/functions.php';
use PHPUnit\Framework\TestCase;

final class RevertStrTest extends TestCase
{
    public function testRevertLettersInWords(): void
    {
        $cases = [
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

        foreach ($cases as $case) {
            $this->assertEquals($case[1], revertStr($case[0]));
        }
    }
}