<?php declare(strict_types=1);

namespace TranslatePigLatin;

use App\Services\TranslatePigLatin\TranslatePigLatinEnum;
use App\Services\TranslatePigLatin\TranslatePigLatinService;
use PHPUnit\Framework\TestCase;

class PigLatinTranslatorTest extends TestCase
{

    private TranslatePigLatinService $translatePigLatinService;

    /** @param mixed[] $data */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $pigLatinEnum = new TranslatePigLatinEnum();
        $this->translatePigLatinService = new TranslatePigLatinService($pigLatinEnum);
    }

    /** @return string[][] */
    public function translateDataProvider(): array
    {
        return [
            'testConsonant' => ['beast', 'eastbay'],
            'testConsonantCluster' => ['strawberry', 'awberrystray'],
            'testVowel' => ['eagle', 'eagleyay'],
            'testSimpleSentence' => ['Quick brown fox jumps over the lazy dog.',
                'uickQay ownbray oxfay umpsjay overyay ethay azylay ogday.'],
            'testComplexSentence' =>  ['His house is very beautiful. That one, over there? Yes, that one!',
                'isHay ousehay isyay eryvay eautifulbay. atThay oneyay, overyay erethay? esYay, atthay oneyay!'],
            'testPunctuationMiddle' => ['ki-ng', 'i-ngkay'],
            'testPunctuationBeginning' => ['!king', '!ingkay'],
        ];
    }

    /** @return string[][] */
    public function nonAlphabeticalStringDataProvider(): array
    {
        return [
            ['testNumber' => '42'],
            ['testPunctuation' => '!'],
            ['testMultiPunctuation' => '?!'],
            ['testSemicolon' => ';'],
            ['testSharp' => '#'],
            ['testDash' => '-']
        ];
    }

    /** @return string[][] */
    public function whitespaceCharacterDataProvider(): array
    {
        return [
            ['testSpace' => ' '],
            ['testTab' => "\t"],
            ['testNewline' => PHP_EOL]
        ];
    }

    /** @dataProvider translateDataProvider */
    public function testTranslate(string $input, string $expectedResult): void
    {
        $result = $this->translatePigLatinService->translate($input);
        $this->assertEquals($expectedResult, $result);
    }

    /** @dataProvider nonAlphabeticalStringDataProvider */
    public function testNonAlphabeticalString(string $input): void
    {
        $result = $this->translatePigLatinService->translate($input);
        $this->assertEquals($input, $result);
    }

    /** @dataProvider whitespaceCharacterDataProvider */
    public function testWhitespaceCharacters(string $input): void
    {
        $result = $this->translatePigLatinService->translate($input);
        $this->assertEquals('', $result);
    }
}
