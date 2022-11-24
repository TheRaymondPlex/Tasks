<?php

namespace Tests\lib;

use application\lib\FileChecker;
use PHPUnit\Framework\TestCase;

class FileCheckerTest extends TestCase
{
    /**
     * @covers \application\lib\FileChecker::deleteDots
     */
    public function testDeleteDots(): void
    {
        $pathToFolder = './uploads';

        $this->assertNotContains('.', FileChecker::deleteDots($pathToFolder));
        $this->assertNotContains('..', FileChecker::deleteDots($pathToFolder));
    }

    /**
     * @covers \application\lib\FileChecker::composingMetaArray
     * @dataProvider composingMetaArrayDataProvider
     */
    public function testComposingMetaArray(array $actualArray): void
    {
        $expectedArray = [
            'zero',
            'one',
            'two',
            'three',
            'four',
            'five',
            'six'
        ];

        $this->assertEquals($expectedArray, FileChecker::composingMetaArray($actualArray));
    }

    public function composingMetaArrayDataProvider(): array
    {

        return [
            'firstArr' => [[
                [
                    'zero',
                    'one',
                    'two'
                ],
                [
                    'three',
                    'four',
                    'five',
                    'six'
                ]
            ]],
            'secondArr' => [[
                [
                    'zero',
                    'one',
                    'two'
                ],
                [
                    'three',
                    'four',
                    'five',
                    [
                        'six'
                    ]
                ]
            ]]
        ];
    }
}
